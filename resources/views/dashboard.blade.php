@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="intro-excerpt">
                        <h1><span class="d-block">PK1.2 Shop</span> <span class="d-block">Marketplace</span></h1>
                        <p class="mb-4">
                            Kami adalah toko online yang menyediakan beragam produk berkualitas dengan harga terjangkau...
                        </p>
                        <p>
                            <a href="{{ route('shop') }}" class="btn btn-secondary me-2">Beli Sekarang</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('biled.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="mb-4 section-title">Produk Terbaru.</h2>
                    <p class="mb-4">Produk terbaru kami yang berkualitas tinggi.</p>
                    <p><a href="{{ route('shop') }}" class="btn">Lihat</a></p>
                </div>

                <!-- Product Items -->
                @forelse ($unggulanProducts as $item)
                    <div class="col-12 col-md-4 col-lg-3 mb-5" data-aos="zoom-in">
                        <a class="product-item" href="{{ route('detail-produk', $item->id) }}">
                            <img src="{{ $item->image1 ? asset('storage/' . $item->image1) : asset('images/product-placeholder.png') }}"
                                class="img-fluid product-thumbnail rounded">
                            <h3 class="product-title">{{ $item->nama }}</h3>
                            <strong class="product-price">Rp{{ number_format($item->harga, 0, ',', '.') }}</strong>
                        </a>
                    </div>
                @empty
                    <p>No products available.</p>
                @endforelse

            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-6" data-aos="fade-up">
                    <div class="row my-5">
                        <div class="col-6 col-md-6" data-aos="zoom-in">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('images/truck.svg') }}" class="img-fluid">
                                </div>
                                <h3>Pengiriman cepat & Gratis Ongkir</h3>
                                <p>Donec vitae odio quis nisl dapibus...</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6" data-aos="zoom-in">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('images/bag.svg') }}" class="img-fluid">
                                </div>
                                <h3>Pembelian Mudah </h3>
                                <p>Donec vitae odio quis nisl dapibus...</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6" data-aos="zoom-in">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('images/support.svg') }}" class="img-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Donec vitae odio quis nisl dapibus...</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6" data-aos="zoom-in">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('images/return.svg') }}" class="img-fluid">
                                </div>
                                <h3>Pengembalian tanpa repot</h3>
                                <p>Donec vitae odio quis nisl dapibus...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left">
                    <div class="img-wrap">
                        <img src="{{ asset('gambar1.jpg') }}" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-7 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="{{ asset('gambar1.jpg') }}"></div>
                        <div class="grid grid-2"><img src="{{ asset('motherboard.jpg') }}"></div>
                        <div class="grid grid-3"><img src="{{ asset('gambar2.jpg') }}"></div>
                    </div>
                </div>

                <div class="col-lg-5 ps-lg-5" data-aos="fade-left">
                    <h2 class="section-title mb-4">Kami Juga Menyediakan</h2>
                    <p>Service Online dan Repair...</p>
                    <ul class="list-unstyled custom-list my-4">
                        <li>Service Mesin Komputer</li>
                        <li>Repair Sparepart</li>
                        <li>Service Laptop</li>
                        <li>Service Tablet</li>
                    </ul>
                    <p><a href="https://wa.me/6289677121092" class="btn">Hubungi Kami</a></p>
                </div>

            </div>
        </div>
    </div>

    <!-- Blog Section -->
    {{-- <div class="blog-section">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-md-6">
                    <h2 class="section-title">Recent Blog</h2>
                </div>
                <div class="col-md-6 text-start text-md-end">
                    <a href="" class="more">View All Posts</a>
                </div>
            </div>
        </div>
    </div> --}}

    <footer class="footer-section">
        <div class="container relative">
            {{-- <div class="sofa-img">
                <img src="{{ asset('images/sofa.png') }}" alt="Image" class="img-fluid">
            </div> --}}

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center">
                            <span class="me-1">
                                <img src="{{ asset('images/envelope-outline.svg') }}" alt="Image" class="img-fluid">
                            </span>
                            <span>Subscribe to Newsletter</span>
                        </h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap">
                        <a href="#" class="footer-logo">PK1.2<span>.</span></a>
                    </div>
                    <p class="mb-4">Kunjungi Media Sosial...</p>
                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="">About us</a></li>
                                <li><a href="">Services</a></li>
                                <li><a href="">Blog</a></li>
                                <li><a href="">Contact us</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Knowledge base</a></li>
                                <li><a href="#">Live chat</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Jobs</a></li>
                                <li><a href="#">Our team</a></li>
                                <li><a href="#">Leadership</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Nordic Chair</a></li>
                                <li><a href="#">Kruzo Aero</a></li>
                                <li><a href="#">Ergonomic Chair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6 text-center text-lg-start">
                        <p class="mb-2">&copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All Rights Reserved. Designed by <a
                                href="https://github.com/adansyah">Relaxed
                                Child</a>
                        </p>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </footer>
@endsection
