@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="container text-center py-5" data-aos="fade-up">
        <h1 class="fw-bold display-5 text-dark mb-3">
            TAV
        </h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 700px;">
            Kami adalah toko online yang menyediakan beragam produk berkualitas dengan harga terjangkau,
            serta memberikan pengalaman belanja online yang cepat, aman, dan nyaman untuk seluruh pelanggan di Indonesia.
        </p>
    </section>

    {{-- VISI & MISI --}}
    <section class="bg-transparent py-5">
        <div class="container">
            <div class="row g-4">

                {{-- VISI --}}
                <div class="col-md-6" data-aos="fade-right">
                    <div class="p-4 bg-transparent rounded shadow-sm text-center text-md-start card-zoom">
                        <h3 class="fw-bold text-black mb-3 fs-3 text-center">Visi</h3>
                        <p class="text-secondary fs-6">
                            Menjadi platform e-commerce terpercaya di Indonesia dengan fokus pada kualitas produk,
                            pelayanan terbaik dan pengalaman belanja yang menyenangkan. Serta menjadi andalan bagi Anda.
                        </p>
                    </div>
                </div>

                {{-- MISI --}}
                <div class="col-md-6" data-aos="fade-left">
                    <div class="p-4 bg-transparent rounded shadow-sm text-center text-md-start card-zoom">
                        <h3 class="fw-bold text-black mb-3 fs-3 text-center">Misi</h3>
                        <ul class="text-secondary fs-6 list-unstyled">
                            <li class="mb-2">• Menyediakan produk original dan berkualitas tinggi.</li>
                            <li class="mb-2">• Memberikan pengalaman belanja yang mudah & aman.</li>
                            <li class="mb-2">• Menyediakan layanan pelanggan yang responsif dan ramah.</li>
                            <li class="mb-2">• Menghadirkan pengiriman cepat dan terpercaya.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="container py-5">
        <h3 class="fw-bold text-center display-6 mb-5" data-aos="fade-up">Keunggulan Kami</h3>

        <div class="row g-4">

            {{-- Card 1 --}}
            <div class="col-sm-6 col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="p-4 bg-transparent rounded shadow-sm text-center card-zoom">
                    <div class="fs-1 text-warning mb-3">⭐</div>
                    <h4 class="fw-bold mb-2">Produk Berkualitas</h4>
                    <p class="text-muted">
                        Hanya produk terbaik yang kami sediakan, demi kepuasan dan kenyamanan pelanggan.
                    </p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="col-sm-6 col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="p-4 bg-transparent rounded shadow-sm text-center card-zoom">
                    <div class="fs-1 text-warning mb-3">⚡</div>
                    <h4 class="fw-bold mb-2">Pelayanan Cepat</h4>
                    <p class="text-muted">
                        Tim kami siap membantu Anda dengan respon cepat dan solusi terbaik.
                    </p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="col-sm-6 col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="p-4 bg-transparent rounded shadow-sm text-center card-zoom">
                    <div class="fs-1 text-warning mb-3">📦</div>
                    <h4 class="fw-bold mb-2">Pengiriman Aman</h4>
                    <p class="text-muted">
                        Bekerjasama dengan ekspedisi terpercaya agar produk sampai aman dan tepat waktu.
                    </p>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('styles')
    <style>
        .card-zoom {
            transition: all 0.3s ease;
        }

        .card-zoom:hover {
            transform: translateY(-7px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
    </style>
@endsection
