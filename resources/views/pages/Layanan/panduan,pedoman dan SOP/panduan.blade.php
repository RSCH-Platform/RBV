@extends('layouts.app')

@section('content')

<style>
[x-cloak] {
    display: none !important;
}
</style>

<div x-data="globalDelete()" x-init="openDelete = false">

<div class="min-h-screen" style="background: linear-gradient(to bottom, #E0EDFF 0%, #FFFFFF 100%);">

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 pt-10">
        <div class="mb-6">
            <a href="/layanan"
            class="inline-flex items-center gap-2 text-gray-400 hover:text-[#2B3A8C] transition-all duration-200">
                <svg viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M14.9274 0.821427C15.886 1.9316 15.7351 3.57241 14.8115 4.5038L9.11378 9.89524H28.4163C29.8433 9.89524 31 11.0611 31 12.4993C31 13.9376 29.8432 15.1034 28.4163 15.1034H9.11501L14.8122 20.4949C15.8536 21.4791 15.9055 23.1282 14.9281 24.1773C13.9516 25.2269 12.3155 25.2792 11.2746 24.294L0.813837 14.3965C-0.27128 13.3682 -0.27128 11.6305 0.813837 10.6023L11.2746 0.704746C12.4198 -0.356969 13.9753 -0.138045 14.9274 0.821427Z" fill="currentColor"/></svg>
                {{-- <span class="text-sm font-medium">Kembali</span> --}}
            </a>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <h1 class="font-poppins text-4xl font-extrabold text-[#2B3A8C]">
                Panduan, Pedoman & SOP
            </h1>

            <div class="flex items-center gap-4">

                <form method="GET" action="{{ route('panduan.index') }}" class="flex items-center">
                    <div class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari dokumen"
                            class="pl-4 sm:pl-5 pr-11 py-2.5 rounded-xl border border-gray-200 bg-white
                                    w-full sm:w-[240px] lg:w-[287px] h-[44px] sm:h-[49px]
                                    font-montserrat text-sm
                                    focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm transition-all">
                        <div class="absolute right-0 top-0 h-[44px] sm:h-[49px] w-[40px] sm:w-[43px]
                                    flex items-center justify-center
                                    bg-gray-100 rounded-r-xl text-gray-400">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-[20px] h-[20px]"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                    </div>
                </form>

                @auth
                    @if(in_array(auth()->user()->role, ['super_admin','admin']))
                        <a href="{{ route('panduan.create') }}"
                            class="flex items-center justify-center w-[47px] h-[49px] rounded-md border border-gray-300 bg-white text-[#606060] transition hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 py-8 sm:py-10">

        @forelse ($panduans as $item)
        <div class="flex items-center gap-4 py-4 border-b border-gray-200">

            <div onclick="window.open('{{ $item->file ? Storage::disk(config('filesystems.default'))->url($item->file) : '#' }}', '_blank')"
                class="flex items-center gap-4 flex-grow cursor-pointer group">

                <div class="flex-shrink-0 w-14 h-14">
                    <div class="w-14 h-14 bg-red-600 rounded flex flex-col items-center justify-center
                                transition duration-200 group-hover:scale-105 group-hover:shadow-md">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white transition duration-200 group-hover:scale-110"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>

                        <span class="text-white text-[9px] font-bold mt-0.5">
                            PDF
                        </span>

                    </div>
                </div>

                <div class="flex-grow">
                    <p class="font-bold text-[18px] text-gray-800 group-hover:text-blue-600">
                        {{ $item->judul }}
                    </p>
                    <p class="text-sm text-gray-400 mt-0.5">
                        Diunggah pada, {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y') }}
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-8 flex-shrink-0">

                @if($item->file)
                <a href="{{ Storage::disk(config('filesystems.default'))->url($item->file) }}"
                    download
                    class="p-2 bg-gray-300 text-white rounded-lg shadow hover:bg-gray-400 hover:scale-110 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>
                @endif

                @auth
                    @if(in_array(auth()->user()->role, ['super_admin','admin']))
                    <a href="{{ route('panduan.edit', $item->id_panduan) }}"
                        class="p-2 bg-[#00A14C] text-white rounded-lg shadow hover:scale-110 transition">
                        <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M0 20.7488V19.1607C0 18.4681 0.621146 17.9109 1.39197 17.9109H16.9425C17.7126 17.9109 18.3333 18.4683 18.3333 19.1607V20.7488C18.3333 21.4418 17.7126 22 16.9425 22H1.39249C0.621662 22 0.000309294 21.4414 0.000309294 20.7488H0Z" fill="white"/><path d="M15.6339 0.519772C14.8398 -0.250244 13.4596 -0.153911 12.5408 0.737037L10.9375 2.29147L15.354 6.57421L16.9569 5.01977C17.8758 4.12886 17.975 2.7903 17.1796 2.01853L15.6339 0.519772Z" fill="white"/><path d="M9.99314 3.20728L2.45202 10.5203C2.05854 10.9023 1.81478 11.3673 1.72911 11.8341L1.16517 15.0746C1.01466 15.5643 1.64669 16.1465 2.15922 16.04L5.33927 15.5267C5.87779 15.4742 6.40285 15.2069 6.86885 14.8032L14.41 7.48971L9.99314 3.20728Z" fill="white"/></svg>
                    </a>

                    <button type="button"
                        @click.stop="openDeleteModal({{ $item->id_panduan }})"
                        class="p-2 bg-red-500 text-white rounded-lg shadow hover:scale-110 transition">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M8.83688 0C7.54529 0 6.48361 1.05862 6.48012 2.34808H15.5196C15.5163 1.05862 14.4546 0 13.1628 0H8.83688ZM0.789643 3.1369C0.352872 3.13514 -0.0017422 3.48938 6.43936e-06 3.92571C0.00176287 4.35969 0.355201 4.71004 0.789643 4.70849H2.1985L3.13567 18.5838C3.26135 20.4218 4.69655 22 6.60777 22H15.3924C17.3034 22 18.7388 20.4218 18.8645 18.5838L19.8046 4.70849H21.2104C21.6448 4.71024 21.9984 4.35971 22 3.92571C22.0018 3.48939 21.6471 3.13515 21.2104 3.1369C13.6377 3.12598 8.1745 3.1369 0.789742 3.1369H0.789643ZM8.64004 7.85312C9.07681 7.85137 9.43142 8.2056 9.42967 8.64194V16.4952C9.4324 16.9323 9.0776 17.2873 8.64004 17.2857C8.20502 17.284 7.85395 16.9297 7.85644 16.4952V8.64194C7.85469 8.20796 8.20559 7.85472 8.64004 7.85312ZM13.3612 7.85312C13.7956 7.85488 14.1463 8.20794 14.1448 8.64194V16.4952C14.1473 16.9297 13.7962 17.284 13.3612 17.2857C12.923 17.2883 12.5674 16.9328 12.57 16.4952V8.64194C12.5682 8.20504 12.9238 7.85063 13.3612 7.85312Z" fill="white"/></svg>
                    </button>
                    @endif
                @endauth

            </div>

        </div>
        @empty
        <div class="py-20 text-center">
            <p class="text-gray-500 italic">
                {{ request('search') ? 'Dokumen yang anda cari tidak ditemukan.' : 'Belum ada data.' }}
            </p>
        </div>
        @endforelse

        @if($panduans->hasPages())
        <div class="mt-8">{{ $panduans->links() }}</div>
        @endif

    </div>
</div>

<div x-show="openDelete"
     x-cloak
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    
    <div class="bg-white rounded-[30px] p-10 max-w-sm w-full shadow-2xl text-center">
        <h2 class="text-2xl font-bold mb-2">Hapus</h2>
        <p class="text-gray-500 mb-6">Yakin ingin menghapus data ini?</p>

        <div class="flex gap-4">
            <button @click="closeModal()" class="bg-gray-400 text-white py-2 w-full rounded">
                Tidak
            </button>

            <form id="deleteForm" method="POST" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white py-2 w-full rounded">
                    Ya
                </button>
            </form>

        </div>
    </div>
</div>

</div>

<script>
function globalDelete() {
    return {
        openDelete: false,
        selectedId: null,
        openDeleteModal(id) {
            this.selectedId = id
            this.openDelete = true

            this.$nextTick(() => {
                document.getElementById('deleteForm').action = '/panduan/' + id
            })
        },
        closeModal() {
            this.openDelete = false
            this.selectedId = null
        }
    }
}

const searchInput = document.querySelector('input[name="search"]');

if (searchInput) {
    let timeout = null;
    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            this.closest('form').submit();
        }, 500);
    });
}
</script>

@endsection