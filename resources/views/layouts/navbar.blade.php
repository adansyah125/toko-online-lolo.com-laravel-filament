<header class="bg-white sticky top-0 z-[1000] shadow-md">
    <div class="max-w-[1200px] mx-auto px-6 py-3 flex justify-between items-center">

        <!-- Logo -->


        <div class="font-bold flex gap-1 text-[1.3rem] text-[#ff6f00] ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-6 text-[#ff6f00] ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            LOLO
        </div>

        <!-- MOBILE: Cart + Hamburger -->
        <div class="flex items-center gap-4 md:hidden">

            <!-- Cart -->
            <a href="/cart" class="relative text-[#555] hover:text-[#ff6f00] transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                @php
                    $cartCount = session()->has('cart') ? array_sum(array_column(session('cart'), 'qty')) : 0;
                @endphp

                <span
                    class="absolute -top-1 -right-2 bg-[#ff6f00] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ $cartCount }}
                </span>
            </a>

            <!-- HAMBURGER -->
            <button id="hamburgerBtn" class="relative w-8 h-8 flex flex-col justify-center">
                <span class="bar top-1 absolute w-6 h-[3px] bg-[#333] rounded transition-all duration-300"></span>
                <span class="bar top-1/2 absolute w-6 h-[3px] bg-[#333] rounded transition-all duration-300"></span>
                <span class="bar bottom-1 absolute w-6 h-[3px] bg-[#333] rounded transition-all duration-300"></span>
            </button>
        </div>

        <!-- DESKTOP NAV -->
        <nav class="hidden md:flex gap-6 font-semibold">
            <a href="/"
                class="relative text-[#555] hover:text-[#ff6f00] transition
                {{ Request::is('/') ? 'text-[#ff6f00] after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-1 after:h-[3px] after:bg-[#ff6f00]' : '' }}">
                Beranda
            </a>

            <a href="/produk"
                class="relative text-[#555] hover:text-[#ff6f00] transition
                {{ Request::is('produk*') ? 'text-[#ff6f00] after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-1 after:h-[3px] after:bg-[#ff6f00]' : '' }}">
                Produk
            </a>

            {{-- <a href="/promo"
                class="relative text-[#555] hover:text-[#ff6f00] transition
                {{ Request::is('promo') ? 'text-[#ff6f00] after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-1 after:h-[3px] after:bg-[#ff6f00]' : '' }}">
                Promo 🎉
            </a> --}}

            <a href="/about"
                class="relative text-[#555] hover:text-[#ff6f00] transition
                {{ Request::is('about') ? 'text-[#ff6f00] after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-1 after:h-[3px] after:bg-[#ff6f00]' : '' }}">
                Tentang Lolo.com
            </a>
            <a href="/pesanan"
                class="relative text-[#555] hover:text-[#ff6f00] transition
                {{ Request::is('pesanan') ? 'text-[#ff6f00] after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-1 after:h-[3px] after:bg-[#ff6f00]' : '' }}">
                Pesanan
            </a>
        </nav>

        <!-- DESKTOP Login -->
        <div class="hidden md:flex items-center gap-4">

            {{-- Keranjang --}}
            <a href="/cart" class="relative font-bold text-[#555] hover:text-[#ff6f00] transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

                @php
                    $cartCount = session()->has('cart') ? array_sum(array_column(session('cart'), 'qty')) : 0;
                @endphp

                <span
                    class="absolute -top-1 -right-2 bg-[#ff6f00] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ $cartCount }}
                </span>
            </a>

            <hr class="h-6 border-l border-gray-300">

            {{-- Jika BELUM login --}}
            @guest
                <div class="flex gap-2 px-5 py-2 font-semibold">
                    <a href="/register" class="text-[#555] hover:text-[#ff6f00]">Daftar</a>
                    <span class="text-[#555]">|</span>
                    <a href="/login" class="text-[#555] hover:text-[#ff6f00]">Login</a>
                </div>
            @endguest

            {{-- Jika SUDAH login --}}
            @auth
                <div x-data="{ open: false }" class="relative px-5 py-2 font-semibold">

                    <button @click="open = !open"
                        class="flex items-center gap-2 text-[#555] hover:text-[#ff6f00] transition">
                        {{ Auth::user()->name }}

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg py-2 z-50">

                        <a href="/profile" class="block px-4 py-2 hover:bg-gray-100 text-[#555]">
                            Profil
                        </a>

                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button class="block w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu"
        class="hidden bg-white shadow-md border-t px-6 py-4 space-y-4 transform transition-all duration-300 origin-top">

        <!-- MENU LIST -->
        <a href="/" class="block text-[#555] text-lg font-medium hover:text-[#ff6f00] transition">Beranda</a>
        <a href="/produk" class="block text-[#555] text-lg font-medium hover:text-[#ff6f00] transition">Produk</a>
        <a href="/promo" class="block text-[#555] text-lg font-medium hover:text-[#ff6f00] transition">Promo 🎉</a>
        <a href="/about" class="block text-[#555] text-lg font-medium hover:text-[#ff6f00] transition">Tentang
            Lolo.com</a>
        <a href="/pesanan" class="block text-[#555] text-lg font-medium hover:text-[#ff6f00] transition">Pesanan</a>

        <hr class="my-4">

        @auth
            <!-- USER LOGGED IN -->
            <div class="space-y-3">

                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ff6f00&color=fff"
                        class="w-10 h-10 rounded-full shadow">

                    <div>
                        <p class="font-semibold text-gray-800 text-lg">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <a href="/profile"
                    class="block w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition text-[#333]">
                    Profil Saya
                </a>

                <form action="/logout" method="POST">
                    @csrf
                    <button
                        class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <!-- GUEST -->
            <div class="flex items-center gap-3 pt-2">
                <a href="/login" class="font-semibold text-[#ff6f00] text-lg">Login</a>
                <span class="text-[#ff6f00] text-lg">|</span>
                <a href="/register" class="font-semibold text-gray-600 text-lg">Daftar</a>
            </div>
        @endauth

    </div>

</header>

<script>
    const btn = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mobileMenu');
    const bars = btn.querySelectorAll('.bar');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');

        // ANIMASI SLIDE DOWN
        if (!menu.classList.contains('hidden')) {
            menu.classList.add('animate-[fadeDown_0.3s_ease]');
        }

        // ANIMASI HAMBURGER -> X
        bars[0].classList.toggle('rotate-45');
        bars[0].classList.toggle('top-1');
        bars[0].classList.toggle('top-3.5');

        bars[1].classList.toggle('opacity-0');

        bars[2].classList.toggle('-rotate-45');
        bars[2].classList.toggle('bottom-1');
        bars[2].classList.toggle('top-3.5');
    });
</script>

<style>
    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
