@extends('layouts.app')

@section('title', 'Contact')

@section('content')

    <!-- CONTACT SECTION -->
    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6 text-center" data-aos="fade-up">
                <h2 class="fw-bold">Hubungi Kami</h2>
                <p class="text-muted">
                    Temukan kami di platform-platform di bawah ini. Kami senang sekali bisa terhubung dengan Anda!
                </p>
            </div>
        </div>

        <div class="row justify-content-center text-center">

            <!-- Lokasi -->
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="p-4 bg-transparent rounded shadow-sm card-hover">
                    <div class="mb-3">
                        <i class="bi bi-geo-alt-fill fs-1 text-primary"></i>
                    </div>
                    <p class="mb-0">Jl. Pelita Karya 1 No.2 INDONESIA</p>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="p-4 bg-transparent rounded shadow-sm card-hover">
                    <div class="mb-3">
                        <i class="bi bi-envelope-fill fs-1 text-primary"></i>
                    </div>
                    <p class="mb-0">SMKPASUNDAN2@gmail.com</p>
                </div>
            </div>

            <!-- Telepon -->
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="p-4 bg-transparent rounded shadow-sm card-hover">
                    <div class="mb-3">
                        <i class="bi bi-telephone-fill fs-1 text-primary"></i>
                    </div>
                    <p class="mb-0">+62 859 2239 7664</p>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="row justify-content-center text-center mt-5">
            <div class="col-lg-6" data-aos="fade-up">
                <h3 class="fw-bold mb-3">Ikuti Kami</h3>

                <div class="d-flex justify-content-center gap-4">

                    <a href="https://facebook.com" class="social-icon text-primary">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="https://instagram.com" class="social-icon text-danger">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="https://twitter.com" class="social-icon text-info">
                        <i class="bi bi-twitter"></i>
                    </a>

                    <a href="https://linkedin.com" class="social-icon text-dark">
                        <i class="bi bi-linkedin"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .card-hover {
            transition: 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Social icon animasi */
        .social-icon {
            font-size: 2rem;
            transition: 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }
    </style>
@endsection
