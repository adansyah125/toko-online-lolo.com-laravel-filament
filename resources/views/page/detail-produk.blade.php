@extends('layouts.app')

@section('content')
    <section class="max-w-[1200px] mx-auto px-6 mt-10 pb-20">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- GAMBAR PRODUK -->
            <div>
                <!-- Gambar Utama -->
                <img id="mainImage" src="{{ asset('storage/' . $detail->image1) }}"
                    class="w-full h-[380px] rounded-xl object-cover shadow-lg">

                <!-- Thumbnail -->
                <div class="flex gap-3 mt-4">
                    <img src="{{ asset('storage/' . $detail->image1) }}"
                        class="thumbnail w-20 h-20 rounded-lg object-cover border hover:ring-2 hover:ring-[#ff6f00] cursor-pointer">
                    <img src="{{ asset('storage/' . $detail->image2) }}"
                        class="thumbnail w-20 h-20 rounded-lg object-cover border hover:ring-2 hover:ring-[#ff6f00] cursor-pointer">
                    <img src="{{ asset('storage/' . $detail->image3) }}"
                        class="thumbnail w-20 h-20 rounded-lg object-cover border hover:ring-2 hover:ring-[#ff6f00] cursor-pointer">
                </div>
            </div>

            <!-- INFO PRODUK -->
            <div>
                <h1 class="text-3xl font-bold">{{ $detail->nama }}</h1>

                <p class="text-gray-500 mt-2">Kategori: <span class="font-semibold">{{ $detail->Category->nama }}</span></p>

                <p class="text-gray-600 mt-1">
                    Stok: <span class="font-semibold" id="stokProduk">{{ $detail->stok }}</span>
                </p>

                <p class="text-[#ff6f00] text-3xl font-bold mt-4"> Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>

                <p class="mt-6 text-gray-700 leading-relaxed">
                    Deskripsi produk ini sangat lengkap dan detail untuk memberikan informasi kepada pembeli.
                </p>

                <div class="mt-6 flex items-center gap-3">
                    <span class="font-semibold">Jumlah:</span>
                    <button type="button" id="decrease"
                        class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300">−</button>
                    <input type="number" id="qty" value="1" min="1"
                        class="w-12 text-center border rounded-lg">
                    <button type="button" id="increase"
                        class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300">+</button>
                </div>

                <!-- ADD TO CART -->
                <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detail->id }}">
                    <input type="hidden" name="qty" id="inputQty" value="1">
                    <button type="submit" id="addToCartBtn" data-id="{{ $detail->id }}" data-qty="1"
                        class="mt-8 w-full bg-[#ff6f00] text-white py-3 rounded-xl text-lg font-semibold shadow hover:bg-[#e65c00]">
                        Simpan ke Keranjang 🛒
                    </button>
                </form>

                <div id="notif" class="mt-2 text-red-500 font-semibold hidden"></div>

            </div>

        </div>
        <!-- PRODUK TERKAIT -->
        <h2 class="text-[1.6rem] font-bold text-[#ff6f00] mt-16 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @forelse ($relatedProducts as $item)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl overflow-hidden cursor-pointer transition"> <img
                        src="{{ asset('storage/' . $item->image1) }}" class="w-full h-[140px] object-cover">
                    <div class="p-4">
                        <p class="text-sm text-gray-500">{{ $item->Category->nama }}</p>
                        <h3 class="font-semibold text-lg">{{ $item->nama }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2"> {{ $item->deskripsi }} </p>
                        <p class="font-bold text-green-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p> <a
                            href="{{ route('detail-produk', $item->id) }}"
                            class="mt-auto px-4 py-2 bg-[#ff6f00] text-white rounded-lg shadow-lg hover:bg-[#e65c00] text-center block">
                            Lihat Produk </a>
                    </div>
            </div> @empty <p class="text-gray-500 col-span-4 text-center">Tidak ada produk terkait</p>
            @endforelse
        </div>

    </section>

    <script>
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', () => {
                mainImage.src = thumb.src;
            });
        });

        const mainQty = document.getElementById('qty');
        const inputQty = document.getElementById('inputQty');
        const stok = parseInt(document.getElementById('stokProduk').textContent);
        const notif = document.getElementById('notif');
        const form = document.getElementById('addToCartForm');

        document.getElementById('increase').addEventListener('click', () => {
            if (parseInt(mainQty.value) < stok) {
                mainQty.value = parseInt(mainQty.value) + 1;
            } else {
                showNotif('Jumlah melebihi stok!');
            }
            inputQty.value = mainQty.value;
        });

        document.getElementById('decrease').addEventListener('click', () => {
            if (mainQty.value > 1) mainQty.value = parseInt(mainQty.value) - 1;
            inputQty.value = mainQty.value;
        });

        mainQty.addEventListener('input', () => {
            if (mainQty.value < 1) mainQty.value = 1;
            if (mainQty.value > stok) {
                mainQty.value = stok;
                showNotif('Jumlah melebihi stok!');
            }
            inputQty.value = mainQty.value;
        });

        form.addEventListener('submit', (e) => {
            if (parseInt(mainQty.value) > stok) {
                e.preventDefault();
                showNotif('Stok tidak cukup untuk jumlah ini!');
            }
        });

        function showNotif(message) {
            notif.textContent = message;
            notif.classList.remove('hidden');
            setTimeout(() => notif.classList.add('hidden'), 3000);
        }
    </script>
@endsection
