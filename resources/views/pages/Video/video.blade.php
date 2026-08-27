@extends('layouts.app')

@section('content')

<div x-data="globalDelete()">

    <div class="min-h-screen" style="background: linear-gradient(to bottom, #E0EDFF 0%, #FFFFFF 100%);">

        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 pt-8 sm:pt-10">
            <div class="flex items-center justify-between gap-4">

                <h1 class="font-poppins text-4xl font-extrabold text-[#2B3A8C]">
                    Video
                </h1>

                @auth
                    @if(in_array(auth()->user()->role, ['super_admin','admin']))
                        <a href="{{ route('video.create') }}"
                            class="flex items-center justify-center w-[47px] h-[49px]
                                    rounded-md border border-gray-300 bg-white text-[#606060]
                                    transition hover:scale-110">
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

        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 py-8 sm:py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-10">

                @foreach ($videos as $video)

                @php
                    $youtubeId = null;
                    $isInstagram = false;

                    if (preg_match('/(youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $video->file_url, $yt)) {
                        $youtubeId = $yt[2];
                    }

                    if (str_contains($video->file_url, 'instagram.com')) {
                        $isInstagram = true;
                    }
                @endphp

                <div class="relative aspect-square bg-[#EFF4FF] rounded-2xl shadow-lg overflow-hidden flex flex-col">

                    <div class="relative h-[40%] w-full overflow-hidden">

                        <a href="{{ $video->file_url }}" target="_blank" class="block w-full h-full">

                            @if(!empty($video->thumbnail))
                                <img src="{{ filter_var($video->thumbnail, FILTER_VALIDATE_URL) ? $video->thumbnail : Storage::disk('minio')->url($video->thumbnail) }}"
                                    class="w-full h-full object-cover">

                            @elseif($youtubeId)
                                <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                                    class="w-full h-full object-cover">

                            @elseif(str_contains($video->file_url, 'tiktok.com'))
                                <div class="w-full h-full bg-black flex items-center justify-center relative">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-16 h-16 text-white opacity-80"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 3v12.5a2.5 2.5 0 11-2.5-2.5h1V10H6.5A5.5 5.5 0 1012 15.5V7.9a6.5 6.5 0 003.5 1V6a3.5 3.5 0 01-3.5-3H9z"/>
                                    </svg>
                                    <div class="absolute bottom-2 text-xs text-white bg-black/60 px-2 py-1 rounded">
                                        TikTok
                                    </div>
                                </div>

                            @elseif($isInstagram)
                                <div class="w-full h-full bg-gradient-to-br from-pink-500 via-red-500 to-yellow-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-16 h-16 text-white"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7.75 2C4.574 2 2 4.574 2 7.75v8.5C2 19.426 4.574 22 7.75 22h8.5C19.426 22 22 19.426 22 16.25v-8.5C22 4.574 19.426 2 16.25 2h-8.5z"/>
                                    </svg>
                                </div>

                            @else
                                <div class="w-full h-full bg-[#EFF4FF] flex items-center justify-center">
                                    <img src="{{ asset('images/logo.png') }}"
                                        class="w-32 h-32 object-contain opacity-40">
                                </div>
                            @endif

                            <div class="absolute inset-0 flex items-center justify-center bg-black/30 hover:bg-black/40 transition pointer-events-none">
                                <svg class="w-14 h-14 text-white drop-shadow-lg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6 4l10 6-10 6V4z"/>
                                </svg>
                            </div>

                        </a>

                        @auth
                            @if(in_array(auth()->user()->role, ['super_admin','admin']))
                            <div class="absolute top-3 right-3 z-20 flex flex-col gap-2">
                                <a href="{{ route('video.edit', $video->id_video) }}"
                                    class="p-1.5 bg-[#00A14C] text-white rounded-lg shadow hover:scale-110 transition">
                                    <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 object-contain"><path d="M0 20.7488V19.1607C0 18.4681 0.621146 17.9109 1.39197 17.9109H16.9425C17.7126 17.9109 18.3333 18.4683 18.3333 19.1607V20.7488C18.3333 21.4418 17.7126 22 16.9425 22H1.39249C0.621662 22 0.000309294 21.4414 0.000309294 20.7488H0Z" fill="white"/><path d="M15.6339 0.519772C14.8398 -0.250244 13.4596 -0.153911 12.5408 0.737037L10.9375 2.29147L15.354 6.57421L16.9569 5.01977C17.8758 4.12886 17.975 2.7903 17.1796 2.01853L15.6339 0.519772Z" fill="white"/><path d="M9.99314 3.20728L2.45202 10.5203C2.05854 10.9023 1.81478 11.3673 1.72911 11.8341L1.16517 15.0746C1.01466 15.5643 1.64669 16.1465 2.15922 16.04L5.33927 15.5267C5.87779 15.4742 6.40285 15.2069 6.86885 14.8032L14.41 7.48971L9.99314 3.20728Z" fill="white"/></svg>
                                </a>
                                <button @click="openDeleteModal({{ $video->id_video }})"
                                    class="p-1.5 bg-red-500 text-white rounded-lg shadow hover:scale-110 transition">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 object-contain"><path d="M8.83688 0C7.54529 0 6.48361 1.05862 6.48012 2.34808H15.5196C15.5163 1.05862 14.4546 0 13.1628 0H8.83688ZM0.789643 3.1369C0.352872 3.13514 -0.0017422 3.48938 6.43936e-06 3.92571C0.00176287 4.35969 0.355201 4.71004 0.789643 4.70849H2.1985L3.13567 18.5838C3.26135 20.4218 4.69655 22 6.60777 22H15.3924C17.3034 22 18.7388 20.4218 18.8645 18.5838L19.8046 4.70849H21.2104C21.6448 4.71024 21.9984 4.35971 22 3.92571C22.0018 3.48939 21.6471 3.13515 21.2104 3.1369C13.6377 3.12598 8.1745 3.1369 0.789742 3.1369H0.789643ZM8.64004 7.85312C9.07681 7.85137 9.43142 8.2056 9.42967 8.64194V16.4952C9.4324 16.9323 9.0776 17.2873 8.64004 17.2857C8.20502 17.284 7.85395 16.9297 7.85644 16.4952V8.64194C7.85469 8.20796 8.20559 7.85472 8.64004 7.85312ZM13.3612 7.85312C13.7956 7.85488 14.1463 8.20794 14.1448 8.64194V16.4952C14.1473 16.9297 13.7962 17.284 13.3612 17.2857C12.923 17.2883 12.5674 16.9328 12.57 16.4952V8.64194C12.5682 8.20504 12.9238 7.85063 13.3612 7.85312Z" fill="white"/></svg>
                                </button>
                            </div>
                            @endif
                        @endauth

                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h2 class="font-poppins text-xl font-bold text-[#2B3A8C]">
                            {{ $video->judul }}
                        </h2>

                        <p class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($video->tanggal)->translatedFormat('d F Y') }}
                        </p>

                        <p class="text-sm text-gray-600 my-2 line-clamp-2">
                            {{ $video->deskripsi }}
                        </p>

                        <div class="mt-auto text-center">
                            <a href="{{ $video->file_url }}" target="_blank"
                                class="px-10 py-2 bg-[#00A14C] text-white text-sm font-bold rounded-lg hover:bg-emerald-600 transition shadow-md">
                                Lihat
                            </a>
                        </div>
                    </div>

                </div>

                @endforeach

            </div>

            @if($videos->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 sm:py-32 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 sm:h-20 sm:w-20 text-gray-300 mb-4 sm:mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                </svg>
                <p class="font-montserrat font-bold text-gray-400 text-lg sm:text-2xl mb-2">Belum ada video</p>
                <p class="text-gray-400 text-xs sm:text-sm">Video akan muncul di sini setelah ditambahkan.</p>
            </div>
            @endif

        </div>
    </div>

    <template x-if="openDelete">
        <div @click.self="closeModal()"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm px-4">
            <div class="bg-white rounded-[30px] p-10 max-w-sm w-full shadow-2xl text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Hapus</h2>
                <p class="text-gray-500 mb-8">Apa anda yakin ingin hapus?</p>
                <div class="flex gap-4">
                    <button @click="closeModal()"
                        class="bg-gray-400 text-white font-bold py-3 rounded-xl w-full">
                        Tidak
                    </button>
                    <form :action="'/video/' + selectedId" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 text-white font-bold py-3 rounded-xl w-full">
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
            this.selectedId = id;
            this.openDelete = true;
        },
        closeModal() {
            this.openDelete = false;
            this.selectedId = null;
        }
    }
}
</script>

@endsection