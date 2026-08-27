@extends('layouts.app')

@section('content')
<div x-data="globalDeleteAkun()">
<div class="min-h-screen bg-[#F0F4FF] py-8 sm:py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="text-gray-400 hover:text-[#2B3A8C] transition">
                    <svg viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M14.9274 0.821427C15.886 1.9316 15.7351 3.57241 14.8115 4.5038L9.11378 9.89524H28.4163C29.8433 9.89524 31 11.0611 31 12.4993C31 13.9376 29.8432 15.1034 28.4163 15.1034H9.11501L14.8122 20.4949C15.8536 21.4791 15.9055 23.1282 14.9281 24.1773C13.9516 25.2269 12.3155 25.2792 11.2746 24.294L0.813837 14.3965C-0.27128 13.3682 -0.27128 11.6305 0.813837 10.6023L11.2746 0.704746C12.4198 -0.356969 13.9753 -0.138045 14.9274 0.821427Z" fill="currentColor"/></svg>
                </a>
                <div>
                    <h1 class="font-poppins text-3xl sm:text-4xl font-extrabold text-[#2B3A8C] tracking-tight">Kelola Akun</h1>
                    <p class="text-gray-500 text-sm mt-1">Manajemen akun seluruh karyawan RS Citra Husada</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('backup.index') }}"
                    class="flex items-center gap-1.5 px-3 sm:px-5 py-2.5 sm:py-3 bg-white text-green-600 font-bold text-xs sm:text-sm rounded-2xl
                        shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-green-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span class="hidden sm:inline">Backup Data</span>
                </a>

                <button onclick="document.getElementById('modalResetAll').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 sm:px-5 py-2.5 sm:py-3 bg-red-50 text-red-600 font-bold text-xs sm:text-sm rounded-2xl
                        shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <span class="hidden sm:inline">Reset Password Semua</span>
                </button>

                <a href="{{ route('akun.create') }}"
                    class="flex items-center gap-1.5 px-3 sm:px-5 py-2.5 sm:py-3 bg-white text-[#2B3A8C] font-bold text-xs sm:text-sm rounded-2xl
                        shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="hidden sm:inline">Tambah Akun</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 mb-5">
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 rounded-2xl px-5 py-3.5">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="text-sm font-semibold text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 mb-5">
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 rounded-2xl px-5 py-3.5">
            <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <p class="text-sm font-semibold text-red-700">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 sm:p-8">

            <div class="mb-6">
                <form method="GET" action="{{ route('akun.index') }}">
                    <div class="flex flex-wrap gap-3">

                        <div class="flex flex-1 min-w-[200px] rounded-2xl overflow-hidden border border-gray-100 bg-[#F8FAFF]">
                            <div class="px-4 flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama, NIK, jabatan, unit kerja..."
                                class="flex-1 py-3 pr-4 text-sm bg-transparent focus:outline-none text-gray-700 placeholder:text-gray-400">
                        </div>

                        <select name="role"
                            class="bg-[#F8FAFF] border border-gray-100 rounded-2xl py-3 px-5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">
                            <option value="">Semua Role</option>
                            <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="admin"       {{ request('role') == 'admin'       ? 'selected' : '' }}>Admin</option>
                            <option value="sekretaris"  {{ request('role') == 'sekretaris'  ? 'selected' : '' }}>Sekretaris</option>
                            <option value="karyawan"    {{ request('role') == 'karyawan'    ? 'selected' : '' }}>Karyawan</option>
                            <option value="unit"        {{ request('role') == 'unit'        ? 'selected' : '' }}>Unit</option>
                        </select>

                        <button type="submit"
                            class="px-8 py-3 bg-[#2B3A8C] text-white text-sm font-bold rounded-2xl
                                   hover:bg-blue-800 transition shadow-lg shadow-blue-100">
                            Cari
                        </button>

                        @if(request()->hasAny(['search','role']))
                        <a href="{{ route('akun.index') }}"
                            class="px-5 py-3 bg-gray-100 text-gray-600 text-sm font-bold rounded-2xl hover:bg-gray-200 transition">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-50 text-xs uppercase tracking-widest">
                            <th class="text-left px-4 py-4 font-bold">NIK</th>
                            <th class="text-left px-4 py-4 font-bold">Nama Lengkap</th>
                            <th class="text-left px-4 py-4 font-bold hidden md:table-cell">Jabatan</th>
                            <th class="text-left px-4 py-4 font-bold hidden lg:table-cell">Unit Kerja</th>
                            <th class="text-left px-4 py-4 font-bold">Role</th>
                            <th class="text-center px-4 py-4 font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($users as $akun)
                        <tr class="hover:bg-[#F8FAFF] transition
                            {{ $akun->id_user === auth()->user()->id_user ? 'bg-blue-50/30' : '' }}">

                            <td class="px-4 py-4 font-mono text-xs text-gray-500">{{ $akun->nip }}</td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#2B3A8C] flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-xs font-bold">
                                            {{ strtoupper(substr($akun->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-700">{{ $akun->name }}</p>
                                        @if($akun->id_user === auth()->user()->id_user)
                                        <span class="text-[10px] text-[#2B3A8C] font-semibold">— Akun kamu</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            
                            <td class="px-4 py-4 text-xs text-gray-600 hidden md:table-cell">{{ $akun->jabatan ?? '-' }}</td>
                            <td class="px-4 py-4 text-xs text-gray-600 hidden lg:table-cell">
                                {{ $akun->unitKerjas->pluck('unit_name')->join(', ') ?: '-' }}
                                <br>
                                <span class="text-[10px] text-gray-400">
                                    {{ $akun->kategori_unit ?? '' }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $roleConfig = [
                                        'super_admin' => ['bg-purple-100 text-purple-700', 'Super Admin'],
                                        'admin'       => ['bg-blue-100 text-blue-700',     'Admin'],
                                        'sekretaris'  => ['bg-indigo-100 text-indigo-700', 'Sekretaris'],
                                        'karyawan'    => ['bg-gray-100 text-gray-600',     'Karyawan'],
                                        'unit'        => ['bg-green-100 text-green-700',   'Unit'],
                                    ];
                                    [$cls, $lbl] = $roleConfig[$akun->role] ?? ['bg-gray-100 text-gray-500', ucfirst($akun->role)];
                                @endphp
                                <span class="text-[10px] px-2.5 py-1 rounded-full font-bold {{ $cls }}">
                                    {{ $lbl }}
                                </span>
                            </td>

                            <td class="px-2 sm:px-4 py-4">
                                <div class="flex items-center justify-center gap-1.5 sm:gap-2">

                                    <a href="{{ route('akun.edit', $akun->id_user) }}"
                                        class="p-2 sm:p-2 bg-[#00A14C] text-white rounded-lg shadow hover:scale-110 transition flex items-center justify-center min-w-[32px] min-h-[32px]">
                                        <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 object-contain" alt="Edit"><path d="M0 20.7488V19.1607C0 18.4681 0.621146 17.9109 1.39197 17.9109H16.9425C17.7126 17.9109 18.3333 18.4683 18.3333 19.1607V20.7488C18.3333 21.4418 17.7126 22 16.9425 22H1.39249C0.621662 22 0.000309294 21.4414 0.000309294 20.7488H0Z" fill="white"/><path d="M15.6339 0.519772C14.8398 -0.250244 13.4596 -0.153911 12.5408 0.737037L10.9375 2.29147L15.354 6.57421L16.9569 5.01977C17.8758 4.12886 17.975 2.7903 17.1796 2.01853L15.6339 0.519772Z" fill="white"/><path d="M9.99314 3.20728L2.45202 10.5203C2.05854 10.9023 1.81478 11.3673 1.72911 11.8341L1.16517 15.0746C1.01466 15.5643 1.64669 16.1465 2.15922 16.04L5.33927 15.5267C5.87779 15.4742 6.40285 15.2069 6.86885 14.8032L14.41 7.48971L9.99314 3.20728Z" fill="white"/></svg>
                                    </a>

                                    @if($akun->id_user !== auth()->user()->id_user)
                                    <button @click="openDeleteModal({{ $akun->id_user }}, '{{ addslashes($akun->name) }}')"
                                        class="p-2 sm:p-2 bg-red-600 text-white rounded-lg shadow hover:scale-110 transition flex items-center justify-center min-w-[32px] min-h-[32px]">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 object-contain" alt="Hapus"><path d="M8.83688 0C7.54529 0 6.48361 1.05862 6.48012 2.34808H15.5196C15.5163 1.05862 14.4546 0 13.1628 0H8.83688ZM0.789643 3.1369C0.352872 3.13514 -0.0017422 3.48938 6.43936e-06 3.92571C0.00176287 4.35969 0.355201 4.71004 0.789643 4.70849H2.1985L3.13567 18.5838C3.26135 20.4218 4.69655 22 6.60777 22H15.3924C17.3034 22 18.7388 20.4218 18.8645 18.5838L19.8046 4.70849H21.2104C21.6448 4.71024 21.9984 4.35971 22 3.92571C22.0018 3.48939 21.6471 3.13515 21.2104 3.1369C13.6377 3.12598 8.1745 3.1369 0.789742 3.1369H0.789643ZM8.64004 7.85312C9.07681 7.85137 9.43142 8.2056 9.42967 8.64194V16.4952C9.4324 16.9323 9.0776 17.2873 8.64004 17.2857C8.20502 17.284 7.85395 16.9297 7.85644 16.4952V8.64194C7.85469 8.20796 8.20559 7.85472 8.64004 7.85312ZM13.3612 7.85312C13.7956 7.85488 14.1463 8.20794 14.1448 8.64194V16.4952C14.1473 16.9297 13.7962 17.284 13.3612 17.2857C12.923 17.2883 12.5674 16.9328 12.57 16.4952V8.64194C12.5682 8.20504 12.9238 7.85063 13.3612 7.85312Z" fill="white"/></svg>
                                    </button>
                                    @else
                                    <div class="p-2 bg-gray-100 text-gray-300 rounded-lg cursor-not-allowed flex items-center justify-center min-w-[32px] min-h-[32px]"
                                        title="Tidak bisa hapus akun sendiri">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </div>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-20 text-center text-gray-400 italic">
                                Tidak ada akun ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
            <div class="mt-8 pt-6 border-t border-gray-50">
                {{ $users->links() }}
            </div>
            @endif

        </div>
    </div>
</div>

<template x-if="openDelete">
    <div @click.self="closeModal()"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-[30px] p-10 max-w-sm w-full shadow-2xl text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Hapus Akun</h2>
            <p class="text-gray-500 mb-2">Apa anda yakin ingin menghapus akun</p>
            <p class="font-bold text-[#2B3A8C] mb-8" x-text="selectedName"></p>
            <div class="flex gap-4">
                <button @click="closeModal()"
                    class="bg-gray-400 text-white font-bold py-3 rounded-xl w-full">
                    Tidak
                </button>
                <form :action="'/akun/' + selectedId" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white font-bold py-3 rounded-xl w-full">
                        Ya
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

</div>

<div id="modalResetAll" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         onclick="document.getElementById('modalResetAll').classList.add('hidden')"></div>

    <div class="relative z-10 w-full max-w-md mx-4 bg-white rounded-2xl shadow-2xl p-6 sm:p-8">

        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="font-poppins font-bold text-gray-800 text-lg">Reset Password Semua Akun</h2>
                <p class="text-xs text-gray-400">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-5">
            <p class="text-xs text-red-700 font-semibold">
                ⚠️ Seluruh akun karyawan (kecuali akun kamu) akan berganti password sesuai yang kamu isi.
            </p>
        </div>

        <form action="{{ route('akun.reset-all-password') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-xs text-gray-500 mb-1.5 ml-1 font-semibold">Password Baru</label>
                <div class="relative">
                    <input type="password" name="password_baru" id="passwordBaru"
                        placeholder="Masukkan password baru..." required minlength="6"
                        class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 pr-10 text-sm
                               focus:outline-none focus:ring-2 focus:ring-red-400">
                    <button type="button" onclick="toggleModalPw()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="modalEye" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <p class="text-[10px] text-gray-400 mt-1 ml-1">Minimal 6 karakter</p>
            </div>

            <div id="step1" class="grid grid-cols-2 gap-3">
                <button type="button"
                    onclick="document.getElementById('modalResetAll').classList.add('hidden')"
                    class="py-2.5 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="button" onclick="showKonfirmasi()"
                    class="py-2.5 bg-red-600 text-white text-sm font-bold rounded-xl hover:bg-red-700 transition">
                    Lanjut
                </button>
            </div>

            <div id="step2" class="hidden">
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 mb-4">
                    <p class="text-xs text-yellow-700 font-semibold text-center">
                        Apakah kamu yakin ingin mereset password seluruh akun?
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" onclick="hideKonfirmasi()"
                        class="py-2.5 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-200 transition">
                        Tidak
                    </button>
                    <button type="submit"
                        class="py-2.5 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-700 transition">
                        Ya, Reset Semua
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
function globalDeleteAkun() {
    return {
        openDelete: false,
        selectedId: null,
        selectedName: '',
        openDeleteModal(id, name) {
            this.selectedId   = id;
            this.selectedName = name;
            this.openDelete   = true;
        },
        closeModal() {
            this.openDelete   = false;
            this.selectedId   = null;
            this.selectedName = '';
        }
    }
}

function showKonfirmasi() {
    const pw = document.getElementById('passwordBaru').value;
    if (!pw || pw.length < 6) {
        alert('Password minimal 6 karakter.');
        return;
    }
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
}
function hideKonfirmasi() {
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
}
function toggleModalPw() {
    const input = document.getElementById('passwordBaru');
    const icon  = document.getElementById('modalEye');
    if (input.type === 'password') {
        input.type     = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"/>';
    } else {
        input.type     = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}
</script>

@endsection