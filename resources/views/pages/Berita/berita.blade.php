@extends('layouts.app')

@section('content')

<div x-data="globalDelete()">

<div class="min-h-screen" style="background: linear-gradient(to bottom, #E0EDFF 0%, #FFFFFF 100%);">

    <div class="max-w-7xl mx-auto px-16 pt-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <h1 class="font-poppins text-4xl font-extrabold text-[#2B3A8C]">
                {{ $kategori ?? 'Berita Terkini' }}
            </h1>

            <div class="flex items-center gap-8">
                
                <form method="GET" action="{{ URL::current() }}">
                    
                    <div x-data="{ open: false, selected: '{{ $kategori ?? 'Kategori' }}' }" class="relative w-[180px]">

                        <button type="button"
                            @click="open = !open"
                            class="w-[197px] h-[49px] bg-[#F5F5F5] bg-white border border-gray-400 rounded-[5px] px-3 py-2
                                text-gray-600 text-sm font-serial font-montserrat text-[20px]
                                flex justify-between items-center shadow-sm">

                            <span x-text="selected"></span>

                            <img src="{{ asset('images/Vector.svg') }}"
                                class="w-[12px] h-[6px] transition-transform duration-300"
                                :class="open ? 'rotate-180' : ''">
                        </button>

                        <div x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute w-[197px] mt-2 bg-white border border-gray-300 rounded-[5px] shadow-lg z-50 overflow-hidden font-montserrat">

                            <div 
                                @click="selected='Kategori'; open=false; $refs.input.value=''; $el.closest('form').submit()"
                                class="px-3 py-2 hover:bg-gray-200 cursor-pointer text-[20px] text-gray-600">
                                Semua
                            </div>

                            @foreach($kategoris as $item)
                                <div 
                                    @click="selected='{{ $item }}'; open=false; $refs.input.value='{{ $item }}'; $el.closest('form').submit()"
                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-[20px] text-gray-600">
                                    {{ $item }}
                                </div>
                            @endforeach

                        </div>

                        <input type="hidden" name="kategori" x-ref="input" value="{{ $kategori }}">

                    </div>

                </form>

                @auth
                    @if(in_array(auth()->user()->role, ['super_admin','admin']))
                        <a href="{{ route('berita.create') }}"
                            class="flex items-center justify-center w-[47px] h-[49px] rounded-md border border-gray-300 bg-white text-[#606060] transition hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 py-8 sm:py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-10">

            @forelse ($berita as $berita)

            <div class="relative aspect-square bg-[#EFF4FF] rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden flex flex-col">
    
                <div class="relative h-[40%] w-full">
                    <img src="{{ Storage::disk(config('filesystems.default'))->url($berita->cover) }}"
                        class="w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/400x300'">

                    @auth
                    @if(in_array(auth()->user()->role, ['super_admin','admin']))
                    <div class="absolute top-3 right-3 z-20 flex flex-col gap-2">

                        <a href="{{ route('berita.edit', $berita->id_berita) }}"
                            class="p-1.5 bg-[#00A14C] text-white rounded-lg shadow hover:scale-110 transition">
                            <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M0 20.7488V19.1607C0 18.4681 0.621146 17.9109 1.39197 17.9109H16.9425C17.7126 17.9109 18.3333 18.4683 18.3333 19.1607V20.7488C18.3333 21.4418 17.7126 22 16.9425 22H1.39249C0.621662 22 0.000309294 21.4414 0.000309294 20.7488H0Z" fill="white"/><path d="M15.6339 0.519772C14.8398 -0.250244 13.4596 -0.153911 12.5408 0.737037L10.9375 2.29147L15.354 6.57421L16.9569 5.01977C17.8758 4.12886 17.975 2.7903 17.1796 2.01853L15.6339 0.519772Z" fill="white"/><path d="M9.99314 3.20728L2.45202 10.5203C2.05854 10.9023 1.81478 11.3673 1.72911 11.8341L1.16517 15.0746C1.01466 15.5643 1.64669 16.1465 2.15922 16.04L5.33927 15.5267C5.87779 15.4742 6.40285 15.2069 6.86885 14.8032L14.41 7.48971L9.99314 3.20728Z" fill="white"/></svg>
                        </a>

                        <button @click="openDeleteModal({{ $berita->id_berita }})"
                            class="p-1.5 bg-red-500 text-white rounded-lg shadow hover:scale-110 transition">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M8.83688 0C7.54529 0 6.48361 1.05862 6.48012 2.34808H15.5196C15.5163 1.05862 14.4546 0 13.1628 0H8.83688ZM0.789643 3.1369C0.352872 3.13514 -0.0017422 3.48938 6.43936e-06 3.92571C0.00176287 4.35969 0.355201 4.71004 0.789643 4.70849H2.1985L3.13567 18.5838C3.26135 20.4218 4.69655 22 6.60777 22H15.3924C17.3034 22 18.7388 20.4218 18.8645 18.5838L19.8046 4.70849H21.2104C21.6448 4.71024 21.9984 4.35971 22 3.92571C22.0018 3.48939 21.6471 3.13515 21.2104 3.1369C13.6377 3.12598 8.1745 3.1369 0.789742 3.1369H0.789643ZM8.64004 7.85312C9.07681 7.85137 9.43142 8.2056 9.42967 8.64194V16.4952C9.4324 16.9323 9.0776 17.2873 8.64004 17.2857C8.20502 17.284 7.85395 16.9297 7.85644 16.4952V8.64194C7.85469 8.20796 8.20559 7.85472 8.64004 7.85312ZM13.3612 7.85312C13.7956 7.85488 14.1463 8.20794 14.1448 8.64194V16.4952C14.1473 16.9297 13.7962 17.284 13.3612 17.2857C12.923 17.2883 12.5674 16.9328 12.57 16.4952V8.64194C12.5682 8.20504 12.9238 7.85063 13.3612 7.85312Z" fill="white"/></svg>
                        </button>

                    </div>
                    @endif
                    @endauth
                </div>

                <div class="p-5 flex flex-col flex-grow">

                    <div>
                        <p class="text-[10px] text-[#00A14C] font-bold uppercase">
                            {{ $berita->kategori }}
                        </p>

                        <h2 class="text-xl font-bold text-[#2B3A8C] line-clamp-2">
                            {{ $berita->judul }}
                        </h2>

                        <p class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <p class="text-sm text-gray-600 line-clamp-2 my-2">
                        {{ $berita->deskripsi }}
                    </p>

                    <div class="mt-auto text-center">
                        <a href="{{ $berita->file_url }}" target="_blank"
                            class="px-6 py-2 bg-[#00A14C] text-white font-bold rounded-lg hover:bg-emerald-600">
                            Baca Selengkapnya
                        </a>
                    </div>

                </div>
            </div>

            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 italic">Data tidak ada.</p>
            </div>
            @endforelse

        </div>
    </div>
</div>

<template x-if="openDelete">
    <div @click.self="closeModal()"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
        <div class="bg-white rounded-[30px] p-10 max-w-sm w-full shadow-2xl text-center">
            <h2 class="text-2xl font-bold mb-2">Hapus</h2>
            <p class="text-gray-500 mb-6">Yakin hapus?</p>

            <div class="flex gap-4">
                <button @click="closeModal()" class="bg-gray-400 text-white font-bold py-3 rounded-xl w-full">
                    Tidak
                </button>

                <form :action="'/berita/' + selectedId" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white font-bold py-3 rounded-xl w-full">
                        Ya
                    </button>
                </form>
            </div>

        </div>
    </div>
</template>

</div>

<script>
function globalDelete() {
    return {
        openDelete: false,
        selectedId: null,

        openDeleteModal(id) {
            this.selectedId = id
            this.openDelete = true
        },

        closeModal() {
            this.openDelete = false
            this.selectedId = null
        }
    }
}
</script>

@endsection