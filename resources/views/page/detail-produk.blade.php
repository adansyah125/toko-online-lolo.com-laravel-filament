@extends('layouts.app')

@section('content')
    <div class="container mt-5 pb-5">

        <div class="row g-5">

            <!-- GAMBAR PRODUK -->
            <div class="col-md-6">

                <!-- Gambar Utama -->
                <div class="bg-transparent rounded shadow-sm overflow-hidden" style="height: 450px;">
                    <img id="mainImage" src="{{ asset('storage/' . $detail->image1) }}" class="w-100 h-100 object-fit-cover">
                </div>


                <!-- Thumbnail -->
                <div class="d-flex gap-2 mt-3">
                    @foreach ([$detail->image1, $detail->image2, $detail->image3] as $thumb)
                        @if ($thumb)
                            <img src="{{ asset('storage/' . $thumb) }}"
                                class="thumbnail rounded object-fit-cover border img-thumbnail"
                                style="width: 80px; height: 80px; cursor:pointer;">
                        @endif
                    @endforeach
                </div>

            </div>

            <!-- INFO PRODUK -->
            <div class="col-md-6">

                <h1 class="fw-bold ">{{ $detail->nama }}</h1>

                <p class="text-muted fs-5">
                    Kategori: <span class="fw-semibold">{{ $detail->Category->nama }}</span>
                </p>

                <p class="text-muted fs-5">
                    Stok: <span class="fw-semibold" id="stokProduk">{{ $detail->stok }}</span>
                </p>

                <p class="text-black producct-price fw-bold fs-2">
                    Rp.{{ number_format($detail->harga, 2) }}
                </p>

                <p class=" text-secondary ">
                    {{ $detail->deskripsi ?? 'Deskripsi produk belum tersedia.' }}
                </p>

                <!-- JUMLAH -->
                <div class="d-flex align-items-center gap-2 mt-4">
                    <span class="fw-semibold fs-5">Jumlah:</span>

                    <button type="button" id="decrease" class="btn btn-light border rounded-circle px-3">−</button>

                    <input type="number" id="qty" value="1" min="1" class="form-control text-center"
                        style="width:70px;">

                    <button type="button" id="increase" class="btn btn-light border rounded-circle px-3">+</button>
                </div>

                <!-- ADD TO CART -->
                <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detail->id }}">
                    <input type="hidden" name="qty" id="inputQty" value="1">

                    <button type="submit" class="btn btn-black text-white w-100 py-3 fs-5 fw-semibold">
                        Simpan ke Keranjang 🛒
                    </button>
                </form>

                <div id="notif" class="alert alert-danger mt-3 d-none"></div>

            </div>

        </div>

        <!-- PRODUK TERKAIT -->
        <h2 class="fw-bold mt-5 ">Produk Terkait</h2>

        {{-- <div class="row g-4">
            @forelse ($relatedProducts as $item)
                <div class="col-6 col-sm-4 col-md-3">

                    @forelse ($relatedProducts as $item)
                        <div class="col-12 col-md-4 col-lg-3 mb-5" data-aos="zoom-in">
                            <a class="product-item" href="{{ route('detail-produk', $item->id) }}">
                                <img src="{{ $item->image1 ? asset('storage/' . $item->image1) : asset('images/product-placeholder.png') }}"
                                    class="img-fluid product-thumbnail">
                                <h3 class="product-title">{{ $item->nama }}</h3>
                                <strong class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-muted">Tidak ada produk terkait</p>
                    @endforelse

                </div>
            @empty
                <p class="text-center text-muted">Tidak ada produk terkait</p>
            @endforelse
        </div> --}}

        <div class="product-section">
            <div class="container">
                <div class="row">
                    <!-- Product Items -->
                    @forelse ($relatedProducts as $item)
                        <div class="col-12 col-md-4 col-lg-3 mb-5" data-aos="zoom-in">
                            <a class="product-item" href="{{ route('detail-produk', $item->id) }}">
                                <img src="{{ $item->image1 ? asset('storage/' . $item->image1) : asset('images/product-placeholder.png') }}"
                                    class="img-fluid product-thumbnail">
                                <h3 class="product-title">{{ $item->nama }}</h3>
                                <strong class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-muted">Tidak ada produk terkait</p>
                    @endforelse

                </div>
            </div>
        </div>

    </div>

    <!-- SCRIPT -->
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

        function showNotif(message) {
            notif.textContent = message;
            notif.classList.remove('d-none');
            setTimeout(() => notif.classList.add('d-none'), 3000);
        }

        document.getElementById('increase').addEventListener('click', () => {
            if (parseInt(mainQty.value) < stok) {
                mainQty.value = parseInt(mainQty.value) + 1;
            } else {
                showNotif('Jumlah melebihi stok!');
            }
            inputQty.value = mainQty.value;
        });

        document.getElementById('decrease').addEventListener('click', () => {
            if (mainQty.value > 1) {
                mainQty.value = parseInt(mainQty.value) - 1;
            }
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
    </script>
@endsection
