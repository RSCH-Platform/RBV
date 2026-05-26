@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-[#E8F0FF] to-white flex flex-col">

    <div class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="max-w-5xl w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

                {{-- Kiri: Ilustrasi --}}
                <div class="flex flex-col items-center justify-center relative">
                    <div class="relative">
                        <div class="w-40 h-16 bg-[#2B3A8C] rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-xl">
                            <span class="font-poppins font-extrabold text-white text-5xl">404</span>
                        </div>
                        <div class="w-64 h-64 sm:w-80 sm:h-80 bg-gradient-to-br from-[#dbeafe] to-[#e0edff] rounded-3xl flex items-center justify-center shadow-inner mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 220" class="w-48 h-48 sm:w-64 sm:h-64">
                                <circle cx="100" cy="60" r="30" fill="#2B3A8C" opacity="0.15"/>
                                <circle cx="100" cy="55" r="22" fill="#2B3A8C" opacity="0.3"/>
                                <rect x="75" y="80" width="50" height="70" rx="10" fill="#2B3A8C" opacity="0.7"/>
                                <rect x="60" y="95" width="20" height="40" rx="8" fill="#2B3A8C" opacity="0.5"/>
                                <rect x="120" y="95" width="20" height="40" rx="8" fill="#2B3A8C" opacity="0.5"/>
                                <rect x="80" y="148" width="17" height="40" rx="8" fill="#2B3A8C" opacity="0.5"/>
                                <rect x="103" y="148" width="17" height="40" rx="8" fill="#2B3A8C" opacity="0.5"/>
                                <circle cx="70" cy="58" r="12" fill="white" stroke="#2B3A8C" stroke-width="2"/>
                                <text x="65" y="63" font-size="14" fill="#2B3A8C" font-weight="bold">?</text>
                                <rect x="45" y="100" width="60" height="50" rx="6" fill="white" opacity="0.6"/>
                                <line x1="52" y1="115" x2="95" y2="115" stroke="#2B3A8C" stroke-width="2" opacity="0.4"/>
                                <line x1="52" y1="125" x2="88" y2="125" stroke="#2B3A8C" stroke-width="2" opacity="0.4"/>
                                <line x1="52" y1="135" x2="80" y2="135" stroke="#2B3A8C" stroke-width="2" opacity="0.4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Teks --}}
                <div class="text-center lg:text-left">
                    <div class="flex items-center justify-center lg:justify-start gap-2 mb-4">
                        <div class="h-px w-8 bg-red-500"></div>
                        <span class="text-red-500 font-bold text-sm">Oops!</span>
                        <div class="h-px w-8 bg-red-500"></div>
                    </div>

                    <h1 class="font-poppins font-extrabold text-[#2B3A8C] text-3xl sm:text-4xl lg:text-5xl mb-4">
                        Halaman Tidak Ditemukan
                    </h1>

                    <p class="text-gray-500 text-sm sm:text-base mb-8 leading-relaxed">
                        Halaman yang kamu cari tidak ada atau sudah dipindahkan.<br>
                        Pastikan URL yang kamu ketik sudah benar.
                    </p>

                    <div class="bg-white border border-gray-200 rounded-2xl px-5 py-3.5 inline-flex items-center gap-3 mb-8 shadow-sm">
                        <svg class="w-5 h-5 text-[#2B3A8C] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-left">
                            <p class="text-xs text-gray-400">Error Code</p>
                            <p class="text-sm font-bold text-gray-700">404 – Page Not Found</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#2B3A8C] text-white font-bold text-sm rounded-2xl
                                   hover:bg-blue-900 hover:shadow-lg transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                        <a href="javascript:history.back()"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-gray-600 font-bold text-sm rounded-2xl
                                   border border-gray-200 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Halaman Sebelumnya
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

</div>
@endsection