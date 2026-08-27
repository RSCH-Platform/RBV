@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F0F4FF]">

    <div class="max-w-4xl mx-auto px-4 sm:px-8 py-6">

        <div class="flex items-center gap-3">

            <a href="{{ route('eoffice.surat-keluar.index') }}"
               class="text-gray-400 hover:text-[#2B3A8C] transition">

                <svg viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M14.9274 0.821427C15.886 1.9316 15.7351 3.57241 14.8115 4.5038L9.11378 9.89524H28.4163C29.8433 9.89524 31 11.0611 31 12.4993C31 13.9376 29.8432 15.1034 28.4163 15.1034H9.11501L14.8122 20.4949C15.8536 21.4791 15.9055 23.1282 14.9281 24.1773C13.9516 25.2269 12.3155 25.2792 11.2746 24.294L0.813837 14.3965C-0.27128 13.3682 -0.27128 11.6305 0.813837 10.6023L11.2746 0.704746C12.4198 -0.356969 13.9753 -0.138045 14.9274 0.821427Z" fill="currentColor"/></svg>

            </a>

            <div>

                <h1 class="font-poppins text-xl sm:text-2xl font-extrabold text-[#2B3A8C]">
                    Tambah Surat Keluar
                </h1>

                <p class="text-gray-400 text-xs">
                    Nomor surat otomatis terisi & urut
                </p>

            </div>

        </div>

    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-8 py-6">

        <form action="{{ route('eoffice.surat-keluar.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5"> 

                    <div>
                        <label class="block text-gray-500 text-xs sm:text-sm mb-1.5 ml-1">
                            No. Surat <span class="text-red-500">*</span>
                        </label>

                         <input type="text"
                            name="nomor_surat"
                            value="{{ old('nomor_surat') }}"
                            required
                            placeholder="001/RSCH/SM/IV/2026"
                            oninvalid="this.setCustomValidity('Nomor surat wajib diisi.')"
                            oninput="this.setCustomValidity('')"
                            class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 text-sm
                                    focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]
                                    @error('nomor_surat') ring-2 ring-red-400 @enderror">

                        @error('nomor_surat')
                            <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p>
                        @else
                            <p class="text-[10px] text-gray-400 mt-1 ml-1">
                                No/RSCH/SK/BulanRomawi/Tahun
                            </p>
                        @enderror
                    </div>

                    <div>

                        <label class="block text-gray-500 text-xs sm:text-sm mb-1.5 ml-1">
                            Tanggal Keluar
                        </label>

                        <input type="date"
                               name="tanggal_keluar"
                               value="{{ now()->format('Y-m-d') }}"
                               required
                               class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#2B3A8C] border-none">

                    </div>

                </div>

                <div>

                    <label class="block text-gray-500 text-xs sm:text-sm mb-1.5 ml-1">
                        Ditujukan Kepada
                    </label>

                    <input type="text"
                           name="tujuan"
                           placeholder="Nama instansi / orang yang dituju"
                           class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-[#2B3A8C] border-none">

                </div>

                <div>

                    <label class="block text-gray-500 text-xs sm:text-sm mb-1.5 ml-1">
                        Perihal
                    </label>

                    <input type="text"
                           name="perihal"
                           required
                           placeholder="Perihal / subjek surat"
                           class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-[#2B3A8C] border-none">

                </div>

                <div>

                    <label class="block text-gray-500 text-xs sm:text-sm mb-1.5 ml-1">
                        Keterangan
                        <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>

                    <textarea name="keterangan"
                              rows="3"
                              placeholder="Contoh: Tagihan biaya perawatan pasien/keluarga BPJS Tenaga Kerja, dll."
                              class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]
                                     resize-none border-none">{{ old('keterangan') }}</textarea>

                </div>

                <div>

                    <label class="block text-gray-500 text-xs sm:text-sm mb-1.5 ml-1 font-semibold text-[#2B3A8C]">
                        File Scan Surat (PDF/JPG)
                    </label>

                    <div class="relative group">

                        <input type="file"
                               name="file_scan"
                               id="fileScan"
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                        <div class="w-full bg-[#F3F4F6] border-2 border-dashed border-gray-200 rounded-xl py-6
                                    flex flex-col items-center justify-center
                                    group-hover:border-[#2B3A8C] transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-8 h-8 text-gray-400 group-hover:text-[#2B3A8C] mb-2"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"/>
                            </svg>

                            <span id="fileLabel"
                                  class="text-xs text-gray-500 group-hover:text-[#2B3A8C]">

                                Klik untuk upload scan surat (PDF/JPG) (Opsional)

                            </span>

                        </div>

                    </div>

                    <p class="text-[10px] text-gray-400 mt-2 ml-1">
                        *Penting untuk arsip digital jika surat sudah dicetak dan distempel manual.
                    </p>

                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-50">

                    <a href="{{ route('eoffice.surat-keluar.index') }}"
                       class="px-6 py-2.5 border border-gray-300 text-gray-600
                              text-sm font-bold rounded-xl hover:bg-gray-50 transition">

                        Batal

                    </a>

                    <button type="submit"
                            class="px-8 py-2.5 bg-[#2B3A8C] text-white text-sm
                                   font-bold rounded-xl hover:bg-blue-800
                                   transition shadow-md">

                        Simpan Surat

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<script>
document.getElementById('fileScan').addEventListener('change', function(e) {

    const f = e.target.files[0];

    if (f) {
        document.getElementById('fileLabel').textContent = f.name;
    }

});
</script>

@endsection