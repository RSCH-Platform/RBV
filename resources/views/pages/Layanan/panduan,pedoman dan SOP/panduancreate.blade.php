@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 sm:py-12 lg:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
           <a href="/layanan"
            class="inline-flex items-center gap-2 text-gray-400 hover:text-[#2B3A8C] transition-all duration-200">
                <svg viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M14.9274 0.821427C15.886 1.9316 15.7351 3.57241 14.8115 4.5038L9.11378 9.89524H28.4163C29.8433 9.89524 31 11.0611 31 12.4993C31 13.9376 29.8432 15.1034 28.4163 15.1034H9.11501L14.8122 20.4949C15.8536 21.4791 15.9055 23.1282 14.9281 24.1773C13.9516 25.2269 12.3155 25.2792 11.2746 24.294L0.813837 14.3965C-0.27128 13.3682 -0.27128 11.6305 0.813837 10.6023L11.2746 0.704746C12.4198 -0.356969 13.9753 -0.138045 14.9274 0.821427Z" fill="currentColor"/></svg>
                {{-- <span class="text-sm font-medium">Kembali</span> --}}
            </a>
        </div>

        <h1 class="font-poppins font-extrabold text-[#272E84] text-center mb-6 sm:mb-8 lg:mb-10
                    text-[55px] sm:text-4xl lg:text-5xl
                    [text-shadow:_0px_4px_5px_rgb(0_0_0_/_40%)]">
            Upload Panduan, Pedoman dan SOP
        </h1>

        <div class="bg-white rounded-[20px] sm:rounded-[30px] shadow-xl border border-gray-100
                    p-6 sm:p-10 lg:p-14">

            <form id="formUpload" action="{{ route('panduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4 sm:space-y-6">

                    <div>
                        <label class="block font-montserrat text-gray-400 text-xs sm:text-sm mb-1.5 sm:mb-2 ml-1">
                            Judul
                        </label>
                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            value="{{ old('judul') }}"
                            class="w-full bg-gray-100 border-none rounded-xl py-2.5 sm:py-3 px-4 sm:px-5
                                    font-montserrat text-sm sm:text-base
                                    focus:ring-2 focus:ring-[#2B3A8C] outline-none"
                            placeholder="Masukkan judul dokumen">
                        <p id="errJudul" class="hidden text-red-500 text-xs mt-1 ml-1">Judul wajib diisi.</p>
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-montserrat text-gray-400 text-xs sm:text-sm mb-1.5 sm:mb-2 ml-1">
                            File
                        </label>
                        <label class="flex items-center gap-3 w-full bg-gray-100 rounded-xl
                                        py-2.5 sm:py-3 px-4 sm:px-5
                                        font-montserrat cursor-pointer hover:bg-gray-200 transition">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <span id="fileTextPanduanCreate" class="text-gray-400 text-xs sm:text-sm italic truncate">
                                File Maksimal 20 MB
                            </span>
                            <input type="file" name="file" id="filePanduanCreate" class="hidden" accept=".pdf">
                        </label>
                        <p id="errFile" class="hidden text-red-500 text-xs mt-1 ml-1">File wajib diupload.</p>
                        @error('file')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-center mt-8 sm:mt-10">
                    <button type="submit"
                        class="bg-[#2B3A8C] text-white font-bold font-poppins rounded-lg
                                hover:bg-blue-800 transition shadow-md
                                py-2.5 sm:py-3 px-10 sm:px-12
                                text-sm sm:text-base w-full sm:w-auto">
                        Upload
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('filePanduanCreate').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('fileTextPanduanCreate').innerText = file.name;
        document.getElementById('errFile').classList.add('hidden');
    }
});

function showErr(id) { document.getElementById(id).classList.remove('hidden'); }
function hideErr(id) { document.getElementById(id).classList.add('hidden'); }

function validasiForm() {
    let valid = true;

    const judul = document.getElementById('judul').value.trim();
    if (!judul) { showErr('errJudul'); valid = false; } else { hideErr('errJudul'); }

    const file = document.getElementById('filePanduanCreate').files.length;
    if (!file) { showErr('errFile'); valid = false; } else { hideErr('errFile'); }

    if (valid) document.getElementById('formUpload').submit();
}
</script>

@endsection