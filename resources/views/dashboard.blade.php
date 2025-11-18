@extends('layouts.app')
@section('content')
    <div id="toast"
        class="hidden fixed right-5 
           px-4 py-3 rounded-lg shadow-lg text-white text-sm opacity-0 
           transition-all duration-300 z-[9999]">
    </div>
    <!-- BANNER SLIDER -->
    <section id="bannerSection" class=" max-w-[1200px] mx-auto mt-8 rounded-xl overflow-hidden shadow-xl relative">
        <div class="flex transition-transform duration-700 overflow-hidden" id="bannerSlide">
            @php
                $latestVideo = $informasi->first();
            @endphp

            @if ($latestVideo && $latestVideo->video)
                <video class="w-full object-cover" autoplay muted loop>
                    <source src="{{ asset('storage/' . $latestVideo->video) }}" type="video/mp4">
                </video>
            @else
                <p class="text-center py-10 mx-auto text-gray-500">Video banner belum tersedia.
                </p>
            @endif
        </div>
    </section>

    <!-- KATEGORI -->
    <section class="max-w-[1200px] mx-auto px-6 mt-12">
        <h2 class="text-[1.5rem] font-bold text-[#ff6f00] mb-5">Kategori</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
            <a href="produk">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl text-center cursor-pointer transition">
                    <div class="text-5xl mb-3 text-[#ff6f00]">🍔</div>
                    <div class="font-semibold text-lg">Makanan</div>
                </div>
            </a>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl text-center cursor-pointer transition">
                <div class="text-5xl mb-3 text-[#ff6f00]">🥛</div>
                <div class="font-semibold text-lg">Minuman</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl text-center cursor-pointer transition">
                <div class="text-5xl mb-3 text-[#ff6f00]">👩‍⚕️</div>
                <div class="font-semibold text-lg">Kesehatan</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl text-center cursor-pointer transition">
                <div class="text-5xl mb-3 text-[#ff6f00]">🌵</div>
                <div class="font-semibold text-lg">Melayang</div>
            </div>
        </div>
    </section>

    <!-- PRODUK UNGGULAN -->
    <section class="max-w-[1200px] mx-auto px-6 mt-12">
        <h2 class="text-[1.6rem] font-bold text-[#ff6f00] mb-6">
            Produk Unggulan
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
            @forelse ($featuredProducts as $item)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl overflow-hidden transition  flex flex-col">
                    <img src="{{ asset('storage/' . $item->image1) }}" class="w-full h-[140px] object-cover" />

                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-sm text-gray-500">{{ $item->Category->nama }}</p>
                        <h3 class="font-semibold text-lg">{{ $item->nama }}</h3>
                        <p class="text-green-600 font-bold text-lg">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <!-- Tombol selalu di paling bawah -->
                        <a href="{{ route('detail-produk', $item->id) }}"
                            class="mt-auto px-4 py-2 bg-[#ff6f00] text-white rounded-lg shadow-lg 
                        hover:bg-[#e65c00] text-center block">
                            Lihat Produk
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 sm:col-span-3 md:col-span-4 text-center text-gray-500 py-10">
                    Produk unggulan tidak tersedia.
                </div>
            @endforelse
        </div>
    </section>


    <footer class="bg-[#ff6f00] text-white mt-12 px-6 py-10">
        <div class="max-w-[1200px] mx-auto grid md:grid-cols-3 gap-4">
            <!-- COL 1 -->
            <div>
                <div class="flex justify-center md:justify-start items-center gap-3 mb-3 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" class="w-9 h-9" viewBox="0 0 24 24">
                        <path
                            d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2c1.104 0 2-.896 2-2s-.896-2-2-2zm9 0c-1.104 0-2 .896-2 2s.896 2 2 2c1.104 0 2-.896 2-2s-.896-2-2-2zM19.727 7.586l-9-1.5a1 1 0 00-1.146.832L7 10H5a1 1 0 100 2h1l1.2 6.4a1 1 0 00.98.8h10a1 1 0 000-2H9.8l-.4-2h8.673a1 1 0 00.98-.804l1-5a1 1 0 00-.326-1.006zM7 12h10.4l-.8 4H8l-.8-4z" />
                    </svg>
                    <h3 class="font-bold text-lg">LOLO.com</h3>
                </div>
                <p>
                    LOLO.com adalah platform e-commerce yang menyediakan berbagai
                    kebutuhan Anda dengan mudah dan nyaman.
                </p>

            </div>

            <!-- COL 2 -->
            <div class="text-center">
                <h3 class="font-bold text-lg mb-3 ">Metode Pembayaran</h3>
                <div class="flex gap-3 items-center">

                    <img src="https://www.freelogovectors.net/wp-content/uploads/2023/02/bri-logo-freelogovectors.net_.png"
                        class="h-9" />
                    <img src="https://iconape.com/wp-content/png_logo_vector/bca-bank-central-asia.png" class="h-9" />
                    <img src="https://logos-world.net/wp-content/uploads/2023/02/Dana-Logo.png" class="h-9" />
                    <img src="https://www.pngkit.com/png/full/989-9894994_ovo-logo-ovo-indonesia.png" class="h-9" />
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjhvTtjN1Bj37W3jTiire9jlqgP046Je6-JPvIVEMjW6avji3kH1eC5HyUDIY8q1l6z89kidy_XZz4cX7-d_rdSentSrY94naUFcRo-NhiEvMUWmevEbQz-xRdMLUFSr61dHVvbVDq58GmxM0UAIgwnfCak8KWr0wTa0UmmjdUQTTcm2pEd3YjuHtPj9Q/s2161/Logo%20QRIS.png"
                        class="h-6 md:h-9" />
                </div>
            </div>

            <!-- COL 3 -->
            <div class=" text-center">
                <h3 class="font-bold text-lg mb-3">Layanan Pelanggan</h3>
                <p>LOLO@example.com</p>
                <p class=" text-white text-sm">
                    📱 +62 858 9987 0978
                </p>
                <p class=" text-white text-sm">
                    ✉️ belanja@example.com
                </p>
            </div>
        </div>

        <div
            class="bg-[#d6cfc9] rounded-lg text-[#222] text-sm mt-10 py-3 px-6 flex justify-between max-w-[1200px] mx-auto">
            <div>LOLO</div>
            <div class="flex gap-4">
                <p class="text-[#222] font-semibold">Privacy Policy</p>
                <p class="text-[#222] font-semibold">Terms & Conditions</p>
            </div>
        </div>
    </footer>
    {{-- script toast --}}
    <script>
        function positionToast() {
            const banner = document.getElementById("bannerSection");
            const toast = document.getElementById("toast");

            if (!banner || !toast) return;

            // Ambil jarak banner dari atas layar
            const rect = banner.getBoundingClientRect();
            const bannerTop = rect.top + window.scrollY;

            // Set posisi toast tepat di samping kanan banner
            toast.style.top = (bannerTop + 20) + "px"; // +20 agar tidak nempel banget
        }

        // Jalankan saat halaman pertama dimuat
        window.addEventListener("load", positionToast);

        // Jalankan saat resize agar tetap sejajar
        window.addEventListener("resize", positionToast);
    </script>

    <script>
        function showToast(message, type = "success") {
            const toast = document.getElementById("toast");

            // Reset class
            toast.className =
                "absolute left-1/2 top-0 transform -translate-x-1/2 mt-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm opacity-0 transition-all duration-300";

            // Warna
            toast.classList.add(type === "error" ? "bg-red-600" : "bg-green-600");

            toast.textContent = message;

            // Tampilkan
            toast.classList.remove("hidden");
            setTimeout(() => {
                toast.style.opacity = "1";
                toast.style.transform = "translateX(-50%) translateY(10px)";
            }, 10);

            // hilang
            setTimeout(() => {
                toast.style.opacity = "0";
                toast.style.transform = "translateX(-50%) translateY(-10px)";
            }, 3000);

            // hide
            setTimeout(() => {
                toast.classList.add("hidden");
            }, 3500);
        }
    </script>


    <script>
        @if (session('toast_success'))
            showToast("{{ session('toast_success') }}", "success");
        @endif

        @if (session('toast_error'))
            showToast("{{ session('toast_error') }}", "error");
        @endif
    </script>
@endsection
