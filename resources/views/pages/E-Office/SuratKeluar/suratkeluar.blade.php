@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F0F4FF] py-8 sm:py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-poppins text-3xl sm:text-5xl font-extrabold text-[#2B3A8C] tracking-tight">Surat Keluar</h1>
                <p class="text-gray-500 text-sm sm:text-base mt-1">Daftar arsip surat keluar resmi</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('eoffice.surat-keluar.export-all') }}"
                    class="flex items-center gap-2 px-5 py-3 bg-white text-green-600 font-bold text-sm rounded-2xl
                           shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Export</span>
                </a>

                @auth
                @if(in_array(auth()->user()->role, ['super_admin', 'sekretaris']))
                <a href="{{ route('eoffice.surat-keluar.create') }}"
                    class="flex items-center gap-2 px-5 py-3 bg-white text-[#2B3A8C] font-bold text-sm rounded-2xl
                           shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Surat</span>
                </a>
                @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 sm:p-8">

            <div class="mb-8">
                <form method="GET" action="{{ route('eoffice.surat-keluar.index') }}">
                    <div class="flex gap-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nomor surat atau tujuan..."
                            class="flex-1 bg-[#F8FAFF] border border-gray-100 rounded-2xl py-3.5 px-6 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#2B3A8C] transition">
                        <button type="submit"
                            class="px-10 py-3.5 bg-[#2B3A8C] text-white text-sm font-bold rounded-2xl
                                   hover:bg-blue-800 transition shadow-lg shadow-blue-100">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-50 text-xs uppercase tracking-widest">
                            {{-- <th class="text-left px-4 py-4 font-bold w-12">No.</th> --}}
                            <th class="text-left px-4 py-4 font-bold">Tanggal</th>
                            <th class="text-left px-4 py-4 font-bold">No. Surat</th>
                            <th class="text-left px-4 py-4 font-bold">Ditujukan Kepada</th>
                            <th class="text-left px-4 py-4 font-bold">Perihal</th>
                            <th class="text-left px-4 py-4 font-bold">Keterangan</th>
                            <th class="text-center px-4 py-4 font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($suratKeluar as $surat)
                        <tr class="hover:bg-[#F8FAFF] transition">

                            {{-- <td class="px-4 py-5 text-gray-400">{{ $loop->iteration }}</td> --}}

                            <td class="px-4 py-5 text-gray-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($surat->tanggal_keluar)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-5 font-mono font-bold text-[#2B3A8C]">
                                {{ $surat->nomor_surat }}
                            </td>

                            <td class="px-4 py-5 text-gray-700 font-medium">
                                {{ $surat->tujuan }}
                            </td>

                            <td class="px-4 py-5 text-gray-600 truncate max-w-xs">
                                {{ $surat->perihal }}
                            </td>

                            <td class="px-4 py-5 text-gray-600 truncate max-w-xs">
                                {{ $surat->keterangan }}
                            </td>

                            <td class="px-4 py-5">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('eoffice.surat-keluar.show', $surat->id) }}"
                                        class="inline-flex items-center justify-center p-2.5 bg-blue-50 text-blue-600
                                               rounded-xl hover:bg-[#2B3A8C] hover:text-white transition"
                                        title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    @if(in_array(auth()->user()->role, ['super_admin', 'sekretaris']))
                                    <a href="{{ route('eoffice.surat-keluar.edit', $surat->id) }}"
                                        class="p-1.5 bg-[#00A14C] text-white rounded-lg shadow hover:scale-110 transition"
                                        title="Edit Surat">
                                        <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="width:19px;height:22px;display:block;"><path d="M0 20.7488V19.1607C0 18.4681 0.621146 17.9109 1.39197 17.9109H16.9425C17.7126 17.9109 18.3333 18.4683 18.3333 19.1607V20.7488C18.3333 21.4418 17.7126 22 16.9425 22H1.39249C0.621662 22 0.000309294 21.4414 0.000309294 20.7488H0Z" fill="white"/><path d="M15.6339 0.519772C14.8398 -0.250244 13.4596 -0.153911 12.5408 0.737037L10.9375 2.29147L15.354 6.57421L16.9569 5.01977C17.8758 4.12886 17.975 2.7903 17.1796 2.01853L15.6339 0.519772Z" fill="white"/><path d="M9.99314 3.20728L2.45202 10.5203C2.05854 10.9023 1.81478 11.3673 1.72911 11.8341L1.16517 15.0746C1.01466 15.5643 1.64669 16.1465 2.15922 16.04L5.33927 15.5267C5.87779 15.4742 6.40285 15.2069 6.86885 14.8032L14.41 7.48971L9.99314 3.20728Z" fill="white"/></svg>
                                    </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-20 text-center text-gray-400">
                                Belum ada data surat keluar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($suratKeluar) && method_exists($suratKeluar, 'hasPages') && $suratKeluar->hasPages())
            <div class="mt-8 pt-6 border-t border-gray-50">
                {{ $suratKeluar->links() }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection