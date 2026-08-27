@extends('layouts.app')

@section('content')
<div class="bg-[#F5F7FB] min-h-screen py-16 flex items-center justify-center">
    <div class="max-w-2xl w-full px-6">
        
        <div class="mb-6">
            <a href="{{ route('akun.index') }}"
            class="inline-flex items-center justify-center w-10 h-10 rounded-full
                    text-gray-400 hover:text-[#2B3A8C] hover:bg-blue-50 transition-all duration-200">
                <svg viewBox="0 0 31 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path d="M14.9274 0.821427C15.886 1.9316 15.7351 3.57241 14.8115 4.5038L9.11378 9.89524H28.4163C29.8433 9.89524 31 11.0611 31 12.4993C31 13.9376 29.8432 15.1034 28.4163 15.1034H9.11501L14.8122 20.4949C15.8536 21.4791 15.9055 23.1282 14.9281 24.1773C13.9516 25.2269 12.3155 25.2792 11.2746 24.294L0.813837 14.3965C-0.27128 13.3682 -0.27128 11.6305 0.813837 10.6023L11.2746 0.704746C12.4198 -0.356969 13.9753 -0.138045 14.9274 0.821427Z" fill="currentColor"/></svg>
            </a>
        </div>

        <form action="{{ route('akun.store') }}" method="POST" id="formTambahAkun">
            @csrf

            <div class="bg-white rounded-[30px] shadow-2xl p-10 md:p-14 border border-gray-50">

                <div class="text-center mb-10">
                    <h1 class="font-poppins text-5xl font-extrabold text-[#272E84] mb-10">
                        Tambah Akun
                    </h1>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-start gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-5">

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">NIK</label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                            class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">
                    </div>

                    <div>

                        <label class="block text-gray-500 text-sm mb-1 ml-1">Jabatan</label>

                        <div class="relative">

                            <select name="id_jabatan"

                                class="w-full appearance-none bg-[#F3F4F6] rounded-xl

                                        py-3 pl-5 pr-10 text-gray-700

                                        focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">

                                <option value="">Pilih Jabatan</option>

                                @foreach($jabatans as $jabatan)

                                    <option value="{{ $jabatan->id_jabatan }}"

                                        {{ old('id_jabatan') == $jabatan->id_jabatan ? 'selected' : '' }}>

                                        {{ $jabatan->nama_jabatan }}

                                    </option>

                                @endforeach

                            </select>

                            <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">

                                <svg xmlns="http://www.w3.org/2000/svg"

                                    class="w-4 h-4"

                                    fill="none"

                                    viewBox="0 0 24 24"

                                    stroke="currentColor">

                                    <path stroke-linecap="round"

                                        stroke-linejoin="round"

                                        stroke-width="2"

                                        d="M19 9l-7 7-7-7"/>

                                </svg>

                            </div>

                        </div>

                        @error('id_jabatan')

                            <p class="text-red-500 text-xs mt-1 ml-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            Unit Kerja
                            <span class="text-gray-400 font-normal text-xs">
                                (Opsional)
                            </span>
                        </label>

                        <div class="flex rounded-xl overflow-hidden border border-gray-200 mb-2">
                            <input type="text" id="searchUnit"
                                oninput="searchUnitHandler(this.value)"
                                placeholder="Ketik untuk mencari unit..."
                                autocomplete="off"
                                class="flex-1 px-4 py-2.5 text-sm bg-[#F3F4F6] focus:outline-none focus:ring-2
                                       focus:ring-[#2B3A8C] text-gray-700 placeholder:text-gray-400">

                            <div class="px-3 py-2.5 bg-[#2B3A8C] flex items-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-width="2"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                        </div>

                        <div id="selectedUnit"
                            class="hidden mb-2 px-4 py-2.5 bg-blue-50 border border-blue-200 rounded-xl flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-[#2B3A8C]">
                                Unit :
                                <span id="selectedUnitNama"></span>
                            </p>

                            <p class="text-xs text-gray-500">
                                Kabid :
                                <span id="selectedUnitKategori"></span>
                            </p>
                        </div>

                            <button type="button"
                                onclick="clearSelectedUnit()"
                                class="text-gray-400 hover:text-red-500 transition ml-3">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div id="unitListContainer"
                            class="hidden max-h-56 overflow-y-auto bg-[#F8FAFF] rounded-xl border border-blue-100 p-2">

                            <div id="unitNotFound"
                                class="hidden px-3 py-4 text-center text-sm text-gray-400">
                                Unit tidak ditemukan
                            </div>

                            @php
                                $grouped = $units->groupBy('kabid');

                                $kategoriColor = [
                                    'Kabid Keperawatan' => 'bg-pink-50 text-pink-700 border-pink-200',
                                    'Kabid Pelayanan Medis' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'Kabid Penunjang Medis' => 'bg-purple-50 text-purple-700 border-purple-200',
                                    'Kabag Umum & Keuangan' => 'bg-green-50 text-green-700 border-green-200',
                                ];
                            @endphp

                            @foreach($grouped as $kategori => $unitList)

                            <div class="kategori-group" data-kategori="{{ $kategori }}">

                                <div class="px-2 py-1.5 mt-1 mb-1">
                                    <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-full border
                                        {{ $kategoriColor[$kategori] ?? 'bg-gray-100 text-gray-500 border-gray-200' }}">
                                        {{ $kategori }}
                                    </span>
                                </div>

                                @foreach($unitList as $u)

                                <label
                                    data-kategori="{{ $u->kabid }}"
                                    data-nama="{{ strtolower($u->nama_unit ?? '') }}"
                                    data-display-nama="{{ $u->nama_unit }}"
                                    data-display-kategori="{{ $u->kabid ?? '' }}"
                                    class="unit-item flex items-center gap-2.5 p-2 rounded-lg hover:bg-blue-100 cursor-pointer transition ml-2">

                                    <input type="radio"
                                        name="id_unit_kerja"
                                        value="{{ $u->id }}"
                                        {{ old('id_unit_kerja') == $u->id ? 'checked' : '' }}
                                        class="unit-radio w-4 h-4 text-[#2B3A8C] focus:ring-[#2B3A8C]">

                                    <div class="flex-1">
                                        <p class="text-xs font-semibold text-gray-700">
                                            {{ $u->nama_unit }}
                                        </p>
                                        <p class="text-[10px] text-gray-500">
                                            {{ $u->kabid }}
                                        </p>
                                    </div>
                                </label>

                                @endforeach
                            </div>

                            @endforeach
                        </div>

                        @error('id_unit_kerja')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">Role</label>

                        <div class="relative">

                            <select name="id_role"
                                class="w-full appearance-none bg-[#F3F4F6] rounded-xl
                                        py-3 pl-5 pr-10 text-gray-700
                                        focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">

                                <option value="">Pilih Role</option>

                                @foreach($roles as $role)
                                    <option value="{{ $role->id_role }}"
                                        {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                                        {{ $role->nama_role }}
                                    </option>
                                @endforeach

                            </select>

                            <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>

                        </div>
                    </div>

                     <div>

                        <label class="block text-gray-500 text-sm mb-1 ml-1">

                            Password
                            <span class="text-gray-400 font-normal text-xs">
                                (Kosongkan jika tidak ingin mengubah)
                            </span>

                        </label>

                        <div class="relative">

                            <input type="password"
                                name="password"
                                id="password"
                                autocomplete="new-password"
                                oninput="checkPasswordMatch()"
                                placeholder="Password baru (opsional)"
                                class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 pr-12
                                [&::-ms-reveal]:hidden [&::-ms-clear]:hidden
                                focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">

                            <button type="button"
                                onclick="togglePassword('password','eye-1')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-0.5">

                                <svg id="eye-1"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path class="eye-open"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                    <path class="eye-open"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5
                                        12 5c4.478 0 8.268 2.943
                                        9.542 7-1.274 4.057-5.064
                                        7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>

                            </button>

                        </div>
                    </div>

                    <div>

                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            Konfirmasi Password
                        </label>

                        <div class="relative">

                            <input type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                autocomplete="new-password"
                                oninput="checkPasswordMatch()"
                                placeholder="Ulangi password baru"
                                class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5 pr-12
                                [&::-ms-reveal]:hidden [&::-ms-clear]:hidden
                                focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">

                            <button type="button"
                                onclick="togglePassword('password_confirmation','eye-2')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-0.5">

                                <svg id="eye-2"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path class="eye-open"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                    <path class="eye-open"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5
                                        12 5c4.478 0 8.268 2.943
                                        9.542 7-1.274 4.057-5.064
                                        7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>

                            </button>

                        </div>

                        <div id="msg-error"
                            class="hidden mt-2 px-4 py-2.5 bg-red-100 text-red-700 rounded-xl flex items-center gap-2 text-sm">

                            Password dan konfirmasi password tidak cocok.
                        </div>

                        <div id="msg-ok"
                            class="hidden mt-2 px-4 py-2.5 bg-green-100 text-green-700 rounded-xl flex items-center gap-2 text-sm">

                            Password cocok.
                        </div>

                    </div>

                    <div class="flex justify-center mt-10">

                        <button type="submit"
                            class="bg-[#2B3A8C] text-white font-bold py-3 px-12 rounded-lg hover:bg-blue-800 transition">

                            Simpan
                        </button>

                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
const unitList = document.getElementById('unitListContainer');
const selectedBox = document.getElementById('selectedUnit');
const notFound = document.getElementById('unitNotFound');

function togglePassword(inputId, svgId) {

    const input = document.getElementById(inputId);

    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}

function checkPasswordMatch() {

    const pw = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;

    const errDiv = document.getElementById('msg-error');
    const okDiv = document.getElementById('msg-ok');

    if (pw === '' && confirm === '') {

        errDiv.classList.add('hidden');
        okDiv.classList.add('hidden');

        return;
    }

    if (confirm === '') {

        errDiv.classList.add('hidden');
        okDiv.classList.add('hidden');

        return;
    }

    if (pw !== confirm) {

        errDiv.classList.remove('hidden');
        okDiv.classList.add('hidden');

    } else {

        errDiv.classList.add('hidden');
        okDiv.classList.remove('hidden');
    }
}
document.getElementById('formTambahAkun')
.addEventListener('submit', function (e) {

    const pw = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;

    if (pw !== '' && pw !== confirm) {

        e.preventDefault();

        document.getElementById('msg-error')
        .classList.remove('hidden');

        document.getElementById('msg-ok')
        .classList.add('hidden');
    }
});

function searchUnitHandler(val)
{
    const q = val.trim().toLowerCase();

    if(q === '')
    {
        unitList.classList.add('hidden');
        return;
    }

    unitList.classList.remove('hidden');

    const items = document.querySelectorAll('.unit-item');
    const groups = document.querySelectorAll('.kategori-group');

    let adaHasil = false;

    items.forEach(item => {

        const nama = item.getAttribute('data-nama') || '';
        const cocok = nama.includes(q);

        item.style.display = cocok ? '' : 'none';

        if(cocok) adaHasil = true;
    });

    groups.forEach(group => {

        const visibleItems = group.querySelectorAll('.unit-item:not([style*="none"])');

        group.style.display = visibleItems.length > 0 ? '' : 'none';
    });

    notFound.classList.toggle('hidden', adaHasil);
}

document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('.unit-radio').forEach(radio => {

        radio.addEventListener('change', function(){

            const label = this.closest('label');

            document.getElementById('selectedUnitNama').textContent =
                label.getAttribute('data-display-nama');

            document.getElementById('selectedUnitKategori').textContent =
                label.getAttribute('data-display-kategori');

            selectedBox.classList.remove('hidden');

            unitList.classList.add('hidden');

            document.getElementById('searchUnit').value = '';
        });
    });

    // Trigger selection for initially checked radio button
    const checkedRadio = document.querySelector('.unit-radio:checked');
    if (checkedRadio) {
        checkedRadio.dispatchEvent(new Event('change'));
    }
});

function clearSelectedUnit()
{
    document.querySelectorAll('.unit-radio').forEach(r => r.checked = false);

    selectedBox.classList.add('hidden');

    document.getElementById('selectedUnitNama').textContent = '';
    document.getElementById('selectedUnitKategori').textContent = '';

    document.getElementById('searchUnit').value = '';

    unitList.classList.add('hidden');
}
</script>

@endsection