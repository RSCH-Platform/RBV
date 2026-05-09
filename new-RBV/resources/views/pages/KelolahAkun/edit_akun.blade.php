@extends('layouts.app')

@section('content')
<div class="bg-[#F5F7FB] min-h-screen py-16 flex items-center justify-center">
    <div class="max-w-2xl w-full px-6">

        <div class="mb-6">
            <a href="{{ route('akun.index') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full
                        text-gray-400 hover:text-[#2B3A8C] hover:bg-blue-50 transition-all duration-200 -ml-50 -mt-10">

                <img src="{{ asset('images/kembali.svg') }}" class="w-6 h-6">
            </a>
        </div>

        <form action="{{ route('akun.update', $user->id_user) }}"
            method="POST"
            id="formEditAkun">

            @csrf
            @method('PUT')

            <div class="bg-white rounded-[30px] shadow-2xl p-10 md:p-14 border border-gray-50">

                <div class="text-center mb-10">
                    <h1 class="font-poppins text-5xl font-extrabold text-[#272E84] mb-10">
                        Edit Akun
                    </h1>
                </div>

                @if(session('success'))

                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 text-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 flex-shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    {{ session('success') }}

                </div>

                @endif

                @if($errors->any())

                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-start gap-2 text-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 flex-shrink-0 mt-0.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            NIK
                        </label>

                        <input type="text"
                            name="NIK"
                            value="{{ old('NIK', $user->NIK) }}"
                            class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5
                            focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            Nama Lengkap
                        </label>

                        <input type="text"
                            name="nama_lengkap"
                            value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                            class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5
                            focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            Jabatan
                        </label>

                        <input type="text"
                            name="jabatan"
                            value="{{ old('jabatan', $user->jabatan) }}"
                            class="w-full bg-[#F3F4F6] rounded-xl py-3 px-5
                            focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            Unit Kerja
                        </label>

                        <select name="id_unit_kerja"
                            class="w-full appearance-none bg-[#F3F4F6] rounded-xl
                            py-3 px-5 text-gray-700
                            focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">

                            <option value="">Pilih Unit Kerja</option>

                            @foreach($unitKerjas as $unit)

                            <option value="{{ $unit->id_unit_kerja }}"
                                {{ old('id_unit_kerja', $user->id_unit_kerja) == $unit->id_unit_kerja ? 'selected' : '' }}>

                                {{ $unit->nama_unit }}

                            </option>

                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-1 ml-1">
                            Role
                        </label>

                        <div class="relative">

                            <select name="id_role"
                                class="w-full appearance-none bg-[#F3F4F6] rounded-xl
                                py-3 pl-5 pr-10 text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-[#2B3A8C]">

                                @foreach($roles as $role)

                                <option value="{{ $role->id_role }}"
                                    {{ old('id_role', $user->id_role) == $role->id_role ? 'selected' : '' }}>

                                    {{ ucfirst(str_replace('_', ' ', $role->nama_role)) }}

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

document.getElementById('formEditAkun')
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
</script>

@endsection