@extends('layouts.app')

@section('content')
    <!-- HERO -->
    <section class="max-w-[1200px] mx-auto px-6 pt-16 pb-10 text-center ">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
            Lolo.com
        </h1>
        <p class="text-gray-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
            Kami adalah toko online yang menyediakan beragam produk berkualitas dengan harga terjangkau,
            serta memberikan pengalaman belanja online yang cepat, aman, dan nyaman untuk seluruh pelanggan di Indonesia.
        </p>
    </section>

    <!-- VISI & MISI -->
    <section class="bg-white py-14">
        <div class="max-w-[1200px] mx-auto px-6 grid md:grid-cols-2 gap-12">

            <!-- Visi -->
            <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center md:text-start ">
                <h3 class="text-2xl font-bold text-orange-600 mb-4">Visi</h3>
                <p class="text-gray-700 leading-relaxed text-base md:text-lg">
                    Menjadi platform e-commerce terpercaya di Indonesia dengan fokus pada kualitas produk,
                    pelayanan terbaik dan pengalaman belanja yang menyenangkan.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-gray-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center md:text-start ">
                <h3 class="text-2xl font-bold text-orange-600 mb-4">Misi</h3>
                <ul class="text-gray-700 text-base md:text-lg space-y-3">
                    <li>• Menyediakan produk original dan berkualitas tinggi.</li>
                    <li>• Memberikan pengalaman belanja yang mudah & aman.</li>
                    <li>• Menyediakan layanan pelanggan yang responsif dan ramah.</li>
                    <li>• Menghadirkan pengiriman cepat dan terpercaya.</li>
                </ul>
            </div>

        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section class="max-w-[1200px] mx-auto px-6 py-16">
        <h3 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">Keunggulan Kami</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-3">

            <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                <div class="text-5xl mb-4 text-orange-500">⭐</div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Produk Berkualitas</h4>
                <p class="text-gray-600 leading-relaxed">
                    Hanya produk terbaik yang kami sediakan, demi kepuasan dan kenyamanan pelanggan.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                <div class="text-5xl mb-4 text-orange-500">⚡</div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Pelayanan Cepat</h4>
                <p class="text-gray-600 leading-relaxed">
                    Tim kami siap membantu Anda dengan respon cepat dan solusi terbaik.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                <div class="text-5xl mb-4 text-orange-500">📦</div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Pengiriman Aman</h4>
                <p class="text-gray-600 leading-relaxed">
                    Bekerjasama dengan ekspedisi terpercaya agar produk sampai aman dan tepat waktu.
                </p>
            </div>

        </div>
    </section>
@endsection
