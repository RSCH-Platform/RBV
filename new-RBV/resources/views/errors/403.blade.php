@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F0F4FF] flex items-center justify-center px-4">
    <div class="text-center max-w-md mx-auto">

        <div class="mb-8">
            <div class="w-32 h-32 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 15v2m0 0v2m0-2h2m-2 0H10m2-6V7m0 0a9 9 0 110 18A9 9 0 0112 7z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M18.364 5.636A9 9 0 015.636 18.364"/>
                </svg>
            </div>

            <h1 class="font-poppins text-8xl font-extrabold text-[#2B3A8C] mb-2">403</h1>
            <h2 class="font-poppins text-2xl font-bold text-gray-700 mb-3">Akses Ditolak</h2>
            <p class="text-gray-500 text-sm leading-relaxed">
                Kamu tidak memiliki izin untuk mengakses halaman ini.
                Halaman ini hanya dapat diakses oleh pengguna dengan role tertentu.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}"
                class="px-6 py-3 bg-[#2B3A8C] text-white font-bold text-sm rounded-2xl
                       hover:bg-blue-900 hover:shadow-lg transition">
                Kembali ke Beranda
            </a>
            <a href="javascript:history.back()"
                class="px-6 py-3 bg-white text-gray-600 font-bold text-sm rounded-2xl
                       border border-gray-200 hover:bg-gray-50 transition">
                Halaman Sebelumnya
            </a>
        </div>

    </div>
</div>
@endsection