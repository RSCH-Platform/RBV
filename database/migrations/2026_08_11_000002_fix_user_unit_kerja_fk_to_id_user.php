<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kembalikan FK user_unit_kerja.user_id ke referensi users.id_user.
     *
     * Migrasi sebelumnya (2026_07_01_110042) mengubah FK agar mereferensikan
     * kolom iam_id, yang mengakibatkan relasi selalu kosong pada mode non-SSO
     * karena iam_id bernilai NULL untuk user lokal.
     *
     * Saat SSO aktif, IamAuthenticatedListener sudah menggunakan
     * $user->unitKerjas()->sync() dengan model key (id_user), sehingga
     * perubahan ini aman untuk kedua mode.
     */
    public function up(): void
    {
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            // Hapus FK lama yang mereferensikan iam_id
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // Ignore jika FK tidak ada
            }

            // Buat FK baru yang mereferensikan id_user
            $table->foreign('user_id')
                  ->references('id_user')
                  ->on('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('user_unit_kerja', function (Blueprint $table) {
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // Ignore
            }

            $table->foreign('user_id')
                  ->references('iam_id')
                  ->on('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }
};
