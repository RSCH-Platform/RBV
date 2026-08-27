<nav class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-18 lg:h-20">

            <div class="flex items-center gap-10">
                <div class="flex-shrink-0">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Citra Husada" 
                        class="h-10 sm:h-12 lg:h-14 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden lg:flex items-center gap-6 xl:gap-8 text-[13px] xl:text-[15px] text-[#2A318A]">
                    <a href="/" class="font-poppins font-normal hover:text-blue-700 transition">Beranda</a>
                    <a href="/berita" class="font-poppins font-normal hover:text-blue-700 transition">Berita</a>
                    <a href="/koleksi" class="font-poppins font-normal hover:text-blue-700 transition">Buku</a>

                    @auth
                        @if(auth()->user()->hasRole(['super_admin', 'admin', 'karyawan', 'unit', 'sekretaris']))
                            <a href="/favorite" class="font-poppins font-normal hover:text-blue-700 transition">Favorit</a>
                        @endif

                        @if(auth()->user()->hasRole(['super_admin', 'sekretaris', 'kabag', 'unit']))
                        <div class="relative" id="eofficeDropdownWrapper">
                            <button id="eofficeBtn"
                                class="font-poppins font-normal hover:text-blue-700 transition flex items-center gap-1
                                       {{ request()->is('eoffice*') ? 'text-blue-700 font-semibold' : '' }}">
                                E-Office
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="eofficeDropdown"
                                class="absolute left-0 mt-3 w-52 bg-white shadow-xl rounded-2xl hidden z-[9999] border border-gray-100 py-1">
                                <a href="{{ route('eoffice.surat-masuk.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition rounded-t-xl group">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-[#2B3A8C] transition flex-shrink-0">
                                        <svg class="w-4 h-4 text-[#2B3A8C] group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Surat Pengajuan</p>
                                    </div>
                                </a>
                                @if(auth()->user()->hasRole(['super_admin', 'sekretaris']))
                                <a href="{{ route('eoffice.surat-keluar.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 hover:bg-green-50 transition rounded-b-xl group">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-600 transition flex-shrink-0">
                                        <svg class="w-4 h-4 text-green-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Surat Keluar</p>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endauth

                    <a href="/artikel" class="font-poppins font-normal hover:text-blue-700 transition">Artikel</a>
                    <a href="/video" class="font-poppins font-normal hover:text-blue-700 transition">Video</a>
                </div>
            </div>

            <div class="hidden lg:flex items-center gap-3">
                @auth
                    @if(auth()->user()->hasRole(['super_admin', 'sekretaris', 'kabag', 'unit']))
                    <div class="relative" id="bellWrapper">
                        <button id="bellBtn" class="relative p-2 rounded-xl hover:bg-gray-100 transition">
                            <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span id="bellBadge" class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full hidden items-center justify-center">0</span>
                        </button>
                        <div id="bellDropdown" class="absolute right-0 mt-3 w-80 bg-white shadow-xl rounded-2xl hidden z-[9999] border border-gray-100 overflow-hidden">
                            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                                <p class="font-semibold text-sm text-gray-700">Notifikasi</p>
                                <button id="bacaSemuaBtn" onclick="bacaSemua()" class="text-xs text-blue-600 hover:underline">Tandai semua dibaca</button>
                            </div>
                            <div id="notifList" class="max-h-72 overflow-y-auto divide-y divide-gray-50 text-center py-4">
                                <p class="text-xs text-gray-400">Memuat...</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(auth()->user()->hasRole(['super_admin', 'admin', 'karyawan', 'unit', 'sekretaris']))
                        <a href="/layanan"  
                        class="font-poppins px-4 xl:px-6 py-2 border-2 border-blue-900 text-blue-900 rounded-lg font-bold text-sm hover:bg-blue-50 transition whitespace-nowrap">
                        Layanan
                    </a>
                    @endif
                @endauth

                @guest
                    <a href="{{ route('login') }}" 
                        class="px-4 xl:px-6 py-2 bg-blue-900 text-white rounded-lg font-bold text-sm hover:bg-blue-800 transition whitespace-nowrap">
                        Login
                    </a>
                @endguest

@auth
<div class="relative" id="profileDropdownWrapperAll">
    <button id="profileBtnAllRoles" 
            onclick="event.stopPropagation(); document.getElementById('profileDropdownAllRoles').classList.toggle('hidden');" 
            class="focus:outline-none block">
        <svg viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12 object-contain cursor-pointer rounded-full hover:opacity-80 transition"><path d="M10.489 44.2693C11.332 45.0756 12.2329 45.8205 13.1863 46.4978C17.0907 49.2726 21.8566 50.9106 27.0006 50.9106C32.1446 50.9106 36.9105 49.2726 40.8149 46.4978C41.7682 45.8205 42.6692 45.0752 43.5121 44.2693C45.2655 42.5926 46.7668 40.6549 47.948 38.5151C48.9162 36.7604 49.6714 34.8731 50.1765 32.8865C50.6552 31.003 50.9115 29.0304 50.9115 26.9997C50.9115 13.815 40.1853 3.08887 27.0007 3.08887C13.816 3.08887 3.08984 13.815 3.08984 26.9997C3.08984 30.1575 3.71112 33.172 4.82797 35.9341C5.43112 37.4255 6.17892 38.8431 7.05642 40.1684C8.04642 41.6618 9.19912 43.0359 10.4895 44.2693H10.489ZM26.4391 12.6994C29.9178 12.6994 32.7478 15.8754 32.7478 19.7786C32.7478 23.683 29.9178 26.859 26.4391 26.859C22.9603 26.859 20.1303 23.683 20.1303 19.7786C20.1299 15.8745 22.9603 12.6994 26.4391 12.6994ZM27.0002 28.9616C33.9579 28.9616 39.6174 33.4894 39.6174 39.0557C39.6174 39.265 39.6009 39.4706 39.5824 39.677L39.4382 41.2994L14.5613 41.299L14.4171 39.6766C14.3981 39.4706 14.3821 39.2646 14.3821 39.0553C14.3821 33.4897 20.0424 28.9616 27.0003 28.9616L27.0002 28.9616Z" fill="currentColor"/><path d="M26.4386 23.4941C28.0619 23.4941 29.3831 21.8271 29.3831 19.7784C29.3831 17.7304 28.0623 16.0635 26.4386 16.0635C24.8153 16.0635 23.4941 17.7304 23.4941 19.7784C23.4941 21.8272 24.8149 23.4941 26.4386 23.4941Z" fill="currentColor"/><path d="M27.0002 32.3271C22.423 32.3271 18.6109 34.7558 17.875 37.9351H36.1253C35.3891 34.7558 31.5774 32.3271 27.0002 32.3271Z" fill="currentColor"/></svg>
    </button>
    
    <div id="profileDropdownAllRoles"
        class="absolute right-0 mt-3 w-44 bg-white shadow-xl rounded-xl hidden z-[9999] border border-gray-100 py-1">
        <a href="/profil"
            class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 rounded-t-xl transition">
            Profil Saya
        </a>
        @if(auth()->user()->role == 'super_admin')
        <a href="{{ route('akun.index') }}"
            class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition">
            Kelola Akun
        </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" class="px-2 py-1">
            @csrf
            <button type="submit" class="w-full text-left px-2 py-2 text-sm text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition font-medium">
                Logout
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('profileDropdownWrapperAll');
    const dropdown = document.getElementById('profileDropdownAllRoles');
    if (wrapper && dropdown && !wrapper.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
@endauth
            </div>

            <div class="flex lg:hidden items-center gap-2">

                @auth
                @if(auth()->user()->hasRole(['super_admin', 'sekretaris', 'kabag', 'unit']))
                <div class="relative" id="bellWrapperMobile">
                    <button id="bellBtnMobile" class="relative p-2 rounded-xl hover:bg-gray-100 transition">
                        <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span id="bellBadgeMobile" class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full hidden items-center justify-center">0</span>
                    </button>
                    <div id="bellDropdownMobile" class="absolute right-0 mt-3 w-72 bg-white shadow-xl rounded-2xl hidden z-[9999] border border-gray-100 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                            <p class="font-semibold text-sm text-gray-700">Notifikasi</p>
                            <button onclick="bacaSemua()" class="text-xs text-blue-600 hover:underline">Tandai semua dibaca</button>
                        </div>
                        <div id="notifListMobile2" class="max-h-72 overflow-y-auto divide-y divide-gray-50 text-center py-4">
                            <p class="text-xs text-gray-400">Memuat...</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="relative" id="profileDropdownWrapperMobile">
                    <button id="profileBtnMobile" class="p-1">
                        <svg viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 object-contain rounded-full hover:opacity-80 transition"><path d="M10.489 44.2693C11.332 45.0756 12.2329 45.8205 13.1863 46.4978C17.0907 49.2726 21.8566 50.9106 27.0006 50.9106C32.1446 50.9106 36.9105 49.2726 40.8149 46.4978C41.7682 45.8205 42.6692 45.0752 43.5121 44.2693C45.2655 42.5926 46.7668 40.6549 47.948 38.5151C48.9162 36.7604 49.6714 34.8731 50.1765 32.8865C50.6552 31.003 50.9115 29.0304 50.9115 26.9997C50.9115 13.815 40.1853 3.08887 27.0007 3.08887C13.816 3.08887 3.08984 13.815 3.08984 26.9997C3.08984 30.1575 3.71112 33.172 4.82797 35.9341C5.43112 37.4255 6.17892 38.8431 7.05642 40.1684C8.04642 41.6618 9.19912 43.0359 10.4895 44.2693H10.489ZM26.4391 12.6994C29.9178 12.6994 32.7478 15.8754 32.7478 19.7786C32.7478 23.683 29.9178 26.859 26.4391 26.859C22.9603 26.859 20.1303 23.683 20.1303 19.7786C20.1299 15.8745 22.9603 12.6994 26.4391 12.6994ZM27.0002 28.9616C33.9579 28.9616 39.6174 33.4894 39.6174 39.0557C39.6174 39.265 39.6009 39.4706 39.5824 39.677L39.4382 41.2994L14.5613 41.299L14.4171 39.6766C14.3981 39.4706 14.3821 39.2646 14.3821 39.0553C14.3821 33.4897 20.0424 28.9616 27.0003 28.9616L27.0002 28.9616Z" fill="currentColor"/><path d="M26.4386 23.4941C28.0619 23.4941 29.3831 21.8271 29.3831 19.7784C29.3831 17.7304 28.0623 16.0635 26.4386 16.0635C24.8153 16.0635 23.4941 17.7304 23.4941 19.7784C23.4941 21.8272 24.8149 23.4941 26.4386 23.4941Z" fill="currentColor"/><path d="M27.0002 32.3271C22.423 32.3271 18.6109 34.7558 17.875 37.9351H36.1253C35.3891 34.7558 31.5774 32.3271 27.0002 32.3271Z" fill="currentColor"/></svg>
                    </button>
                    <div id="profileDropdownMobile"
                        class="absolute right-0 mt-3 w-44 bg-white shadow-xl rounded-xl hidden z-[9999] border border-gray-100">
                        <a href="/profil"
                            class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-t-xl transition">
                            Profil 
                        </a>
                        @if(auth()->user()->role == 'super_admin')
                        <a href="{{ route('akun.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                            Kelola Akun
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="px-2 py-1">
                            @csrf
                            <button type="submit" class="w-full text-left px-2 py-2 text-sm text-red-500 hover:text-red-700 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                @guest
                <a href="{{ route('login') }}"
                    class="px-3 py-1.5 bg-blue-900 text-white rounded-lg font-bold text-xs sm:text-sm hover:bg-blue-800 transition">
                    Login
                </a>
                @endguest

                <button id="hamburgerBtn"
                    class="p-2 rounded-lg text-[#2A318A] hover:bg-blue-50 transition focus:outline-none"
                    aria-label="Toggle menu">
                    <svg id="iconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="iconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div id="mobileMenu" class="lg:hidden hidden border-t border-gray-100 bg-white shadow-md">
        <div class="px-4 py-4 flex flex-col gap-1">
            <a href="/" class="block px-3 py-2.5 rounded-lg font-poppins text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Beranda</a>
            <a href="/berita" class="block px-3 py-2.5 rounded-lg font-poppins text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Berita</a>
            <a href="/koleksi" class="block px-3 py-2.5 rounded-lg font-poppins text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Buku</a>
            <a href="/artikel" class="block px-3 py-2.5 rounded-lg font-poppins text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Artikel</a>
            <a href="/video" class="block px-3 py-2.5 rounded-lg font-poppins text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Video</a>

            @auth
                @if(auth()->user()->hasRole(['super_admin', 'admin', 'karyawan', 'unit', 'sekretaris']))
                <a href="/favorite" class="block px-3 py-2.5 rounded-lg font-poppins text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Favorit</a>
                @endif

                @if(auth()->user()->hasRole(['super_admin', 'sekretaris', 'kabag', 'unit']))
                <div class="border-t border-gray-100 mt-1 pt-1">
                    <p class="px-3 py-1.5 text-[10px] text-gray-400 font-bold uppercase tracking-widest">E-Office</p>
                    <a href="{{ route('eoffice.surat-masuk.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Surat Masuk</a>
                    @if(auth()->user()->hasRole(['super_admin', 'sekretaris']))
                    <a href="{{ route('eoffice.surat-keluar.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-[#2A318A] font-medium hover:bg-green-50 transition">Surat Keluar</a>
                    @endif
                </div>
                @endif

                <div class="border-t border-gray-100 mt-1 pt-1">
                    <p class="px-3 py-1.5 text-[10px] text-gray-400 font-bold uppercase tracking-widest">Akun</p>
                    @if(auth()->user()->hasRole(['super_admin', 'admin', 'karyawan', 'unit', 'sekretaris']))
                    <a href="/layanan" class="block px-3 py-2.5 rounded-lg text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Layanan</a>
                    @endif
                    <a href="/profil" class="block px-3 py-2.5 rounded-lg text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Profil Saya</a>
                    @if(auth()->user()->role == 'super_admin')
                    <a href="{{ route('akun.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-[#2A318A] font-medium hover:bg-blue-50 transition">Kelola Akun</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-1">
                        @csrf
                        <button type="submit" class="w-full text-left text-sm text-red-500 font-medium py-2 hover:text-red-700 transition">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth

            @guest
            <div class="border-t border-gray-100 mt-1 pt-2 px-3">
                <a href="{{ route('login') }}"
                    class="block w-full text-center px-4 py-2.5 bg-blue-900 text-white rounded-lg font-bold text-sm hover:bg-blue-800 transition">
                    Login
                </a>
            </div>
            @endguest
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {

    function setupDropdown(btnId, dropId, wrapId) {
        const btn  = document.getElementById(btnId);
        const drop = document.getElementById(dropId);
        const wrap = document.getElementById(wrapId);
        if (!btn || !drop || !wrap) return;
        btn.addEventListener('click', e => {
            e.stopPropagation();
            drop.classList.toggle('hidden');
        });
        document.addEventListener('click', e => {
            if (!wrap.contains(e.target)) drop.classList.add('hidden');
        });
    }

    @auth
    @if(auth()->user()->role == 'super_admin')
    setupDropdown('profileBtn', 'profileDropdown', 'profileDropdownWrapper');
    @endif
    @endauth

    setupDropdown('profileBtnMobile', 'profileDropdownMobile', 'profileDropdownWrapperMobile');
    setupDropdown('eofficeBtn', 'eofficeDropdown', 'eofficeDropdownWrapper');
    setupDropdown('bellBtnMobile', 'bellDropdownMobile', 'bellWrapperMobile');

    const bellBtnMobile = document.getElementById('bellBtnMobile');
    if (bellBtnMobile) {
        bellBtnMobile.addEventListener('click', function() {
            const drop = document.getElementById('bellDropdownMobile');
            if (!drop.classList.contains('hidden')) {
                loadNotifikasiMobile();
            }
        });
    }

    const bellBtn  = document.getElementById('bellBtn');
    const bellDrop = document.getElementById('bellDropdown');
    const bellWrap = document.getElementById('bellWrapper');

    if (bellBtn && bellDrop) {
        bellBtn.addEventListener('click', e => {
            e.stopPropagation();
            const isHidden = bellDrop.classList.toggle('hidden');
            if (!isHidden) loadNotifikasi();
        });
        document.addEventListener('click', e => {
            if (bellWrap && !bellWrap.contains(e.target)) {
                bellDrop.classList.add('hidden');
            }
        });
    }

    const hamburger  = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            const hidden = mobileMenu.classList.toggle('hidden');
            document.getElementById('iconOpen').classList.toggle('hidden', !hidden);
            document.getElementById('iconClose').classList.toggle('hidden', hidden);
            if (!hidden) loadNotifikasi();
        });
    }

    const dot = {
        'sukses'    : 'bg-green-500',
        'peringatan': 'bg-yellow-500',
        'info'      : 'bg-blue-500',
    };

    function renderNotifItems(data) {
        if (!data.notifikasi || data.notifikasi.length === 0) {
            return '<p class="text-xs text-gray-400 text-center py-6">Tidak ada notifikasi</p>';
        }
        return data.notifikasi.map(n => `
            <div onclick="tandaiBaca(${n.id}, '${n.url || ''}')"
                class="flex items-start gap-3 px-4 py-3 cursor-pointer hover:bg-[#F8FAFF] transition
                       ${n.dibaca ? 'opacity-60' : 'bg-blue-50/40'}">
                <div class="w-2 h-2 rounded-full flex-shrink-0 mt-2 ${dot[n.tipe] || dot['info']}"></div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold ${n.dibaca ? 'text-gray-600' : 'text-[#2B3A8C]'}">${n.judul}</p>
                    <p class="text-[11px] text-gray-500 mt-0.5 line-clamp-2">${n.pesan}</p>
                    <p class="text-[10px] text-gray-400 mt-1">${n.created_at}</p>
                </div>
                ${!n.dibaca ? '<div class="w-2 h-2 rounded-full bg-[#2B3A8C] flex-shrink-0 mt-2"></div>' : ''}
            </div>
        `).join('');
    }

    function updateBadge(belumDibaca) {
        const badge = document.getElementById('bellBadge');
        const badgeMobile = document.getElementById('bellBadgeMobile');
        [badge, badgeMobile].forEach(b => {
            if (!b) return;
            if (belumDibaca > 0) {
                b.textContent = belumDibaca > 9 ? '9+' : belumDibaca;
                b.classList.remove('hidden');
                b.classList.add('flex');
            } else {
                b.classList.add('hidden');
                b.classList.remove('flex');
            }
        });
    }

    async function loadNotifikasi() {
        const list = document.getElementById('notifList');
        if (!list) return;
        try {
            const res = await fetch('{{ route("notifikasi.index") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            const data = await res.json();
            updateBadge(data.belum_dibaca);
            const html = renderNotifItems(data);
            list.innerHTML = html;
            const listMobile = document.getElementById('notifListMobile');
            if (listMobile) listMobile.innerHTML = html;
        } catch(e) {
            if (list) list.innerHTML = '<p class="text-xs text-gray-400 text-center py-6">Gagal memuat notifikasi.</p>';
        }
    }

    async function loadNotifikasiMobile() {
        const list = document.getElementById('notifListMobile2');
        if (!list) return;
        try {
            const res = await fetch('{{ route("notifikasi.index") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            const data = await res.json();
            updateBadge(data.belum_dibaca);
            list.innerHTML = renderNotifItems(data);
        } catch(e) {
            if (list) list.innerHTML = '<p class="text-xs text-gray-400 text-center py-6">Gagal memuat notifikasi.</p>';
        }
    }

    window.tandaiBaca = async function(id, url) {
        try {
            await fetch(`/notifikasi/${id}/baca`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN'    : document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept'          : 'application/json',
                }
            });
        } catch(e) {}
        if (url) window.location.href = url;
    }

    window.bacaSemua = async function() {
        try {
            await fetch('/notifikasi/baca-semua', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN'    : document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept'          : 'application/json',
                }
            });
        } catch(e) {}
        loadNotifikasi();
        loadNotifikasiMobile();
    }

    async function fetchBadge() {
        try {
            const res = await fetch('{{ route("notifikasi.index") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            const data = await res.json();
            updateBadge(data.belum_dibaca);
        } catch(e) {}
    }

    fetchBadge();
    setInterval(fetchBadge, 30000);

    const bacaSemuaBtn = document.getElementById('bacaSemuaBtn');
    if (bacaSemuaBtn) {
        bacaSemuaBtn.addEventListener('click', () => bacaSemua());
    }
});
</script>