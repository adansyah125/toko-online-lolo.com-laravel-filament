<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="bootstrap, bootstrap4">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <title>TAV - @yield('title')</title>
    <style>
        body {
            font-family: 'glyphicons-halflings', sans-serif;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <!-- Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('logo.png') }}" alt=""
                    style="width: 70px; height:50px"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
                        <a class="nav-link" href="{{ route('dashboard') }}">Beranda</a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('shop')) active @endif">
                        <a class="nav-link" href="{{ route('shop') }}">Produk</a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('pesanan')) active @endif ">
                        <a class="nav-link" href="{{ route('pesanan') }}">Pesanan Saya</a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('about')) active @endif ">
                        <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('contact')) active @endif  ">
                        <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    {{-- Cart Icon --}}
                    <li class="nav-item me-3 position-relative">
                        @php
                            $cart = session('cart', []);
                            $cartCount = array_sum(array_column($cart, 'quantity'));
                        @endphp
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <img src="{{ asset('images/cart.svg') }}" alt="Cart">
                            @if ($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>


                    {{-- User Icon --}}
                    <li class="nav-item dropdown">
                        @auth
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/user.svg') }}" alt="User">
                                <span class="ms-2 text-white">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('user.logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">
                                <img src="{{ asset('images/user.svg') }}" alt="Login">
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

    <!-- End Navigation -->

    <main>
        @yield('content')
    </main>

    <!-- Footer -->

    <!-- End Footer -->

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
