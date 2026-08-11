# Laporan Isu: Mismatch Logika Role dan Jabatan

Dokumen ini menjelaskan *design flaw* (cacat desain) pada arsitektur otorisasi di dalam aplikasi `rbv-app`, secara spesifik terkait tumpang tindih penggunaan `role` dan `jabatan`.

## Konteks Arsitektur
Sistem membedakan dua entitas hak akses:
1. **Role** (di tabel `roles` / pivot `role_user`): `super_admin`, `admin`, `sekretaris`, `karyawan`, `unit`.
    * **Fungsi:** Digunakan sebagai filter visibilitas tampilan (UI) dan pembatasan Middleware (Route).
2. **Jabatan** (di tabel `jabatans` / pivot `jabatan_user`): 
    * `1` = Direktur
    * `2` = Kepala Bagian
    * `3` = Kepala Unit
    * `4` = Sekretaris
    * `5` = Karyawan
    * **Fungsi:** Digunakan secara spesifik di dalam Controller untuk alur *business logic* (Contoh: siapa yang melakukan *approve* surat, siapa yang bisa melakukan disposisi).

---

## Daftar Masalah Kritis

### 1. Case-Sensitivity & Mismatch String di Blade Views
Pada file-file UI (contohnya `suratmasuk.blade.php`), logika tombol dan menu disembunyikan menggunakan pengecekan string dari accessor jabatan:
```php
// CONTOH SALAH
@if(in_array(auth()->user()->jabatan, ['direktur', 'kabag']))

@if(auth()->user()->jabatan === 'kepala unit')
```

**Kenapa ini bermasalah?**
Accessor `auth()->user()->jabatan` mengambil nama jabatan langsung dari database. Data di tabel `jabatans` menggunakan format *Title Case*:
* `Direktur`
* `Kepala Bagian`
* `Kepala Unit`

Karena PHP membedakan huruf besar/kecil (case-sensitive) dan penyebutan "kabag" tidak ada di database (adanya "Kepala Bagian"), maka **seluruh kondisi IF di atas selalu me-return FALSE**. Akibatnya, menu dan tombol khusus direktur/kabag/kepala unit tidak akan pernah muncul di layar.

**Rekomendasi Solusi:**
Gunakan `id_jabatan` untuk logika Blade alih-alih menggunakan string mentah.
```php
// CONTOH BENAR
@if(in_array(auth()->user()->id_jabatan, [1, 2])) // 1=Direktur, 2=Kabag

@if(auth()->user()->id_jabatan == 3) // 3=Kepala Unit
```

---

### 2. Super Admin Tidak Memiliki Hak Istimewa di Level Controller
Di tampilan frontend, `super_admin` atau `admin` diizinkan melihat tombol aksi atau form input (misal: Edit Surat Masuk). Namun, ketika aksi tersebut di-submit, logika Controller menolaknya karena secara buta hanya mengecek ID Jabatan:

```php
// app/Http/Controllers/SuratMasukController.php (Fungsi edit)
if ($user->id_jabatan != 4) {
    return redirect()->route('eoffice.surat-masuk.show', $id);
}
```

**Kenapa ini bermasalah?**
Seorang `super_admin` biasanya bukan berjabatan "Sekretaris" (`id_jabatan = 4`). Saat Super Admin mencoba mengedit surat untuk memperbaiki data, Controller akan secara paksa "melempar" (redirect) Super Admin tersebut ke halaman *Show*. Hal yang sama terjadi pada method `store`.

**Rekomendasi Solusi:**
Controller harus memberikan by-pass untuk `super_admin` dan mengombinasikan pengecekan Role:
```php
// CONTOH BENAR
if ($user->id_jabatan != 4 && !in_array($user->role, ['super_admin', 'admin'])) {
    return redirect()->route('eoffice.surat-masuk.show', $id);
}
```

---

### 3. Logika Routing (Tag Surat) yang Terputus
Saat pembuatan Surat Masuk (`store`), form menyediakan kolom "Tujuan Surat" (Tag Users). Logika di Controller memproses tag ini menjadi status disposisi (`menunggu_direktur`, dsb):

```php
if ($user->id_jabatan == 4) {
    $tagUsers = User::whereIn('id_user', $request->tag_users ?? [])->get();
    // ... tentukan status berdasarkan direktur/kabag ...
}
```

**Kenapa ini bermasalah?**
Lagi-lagi, jika surat ini dibuat oleh orang selain Sekretaris (misalnya Admin atau Super Admin), kondisi ini akan bernilai `false`. Akibatnya, tujuan disposisi yang sudah dipilih akan terabaikan, dan surat akan nyangkut di status awal `menunggu_sekretaris` tanpa notifikasi yang benar ke tujuan yang ditunjuk.

**Rekomendasi Solusi:**
Buka akses blok kode ini bagi mereka yang memiliki Role `super_admin` maupun `admin`:
```php
// CONTOH BENAR
if ($user->id_jabatan == 4 || in_array($user->role, ['super_admin', 'admin'])) {
    // ... proses tujuan ...
}
```

---

## Langkah Lanjut (Action Plan)
Untuk memastikan aplikasi berjalan dengan logika bisnis yang tidak membingungkan, diperlukan:
1. *Refactoring* semua `->jabatan == 'string'` di file `.blade.php` menjadi `->id_jabatan == angka`.
2. Menambahkan `in_array($user->role, ['super_admin', 'admin'])` pada titik-titik krusial pembatasan jabatan di Controller E-Office.
