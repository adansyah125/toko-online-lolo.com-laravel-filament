@extends('layouts.app')

@section('title', 'Shop')

@section('content')

    {{-- SEARCH BAR --}}
    <div class="container my-4" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control form-control-lg"
                    placeholder="Cari nama produk atau kategori...">
            </div>
        </div>
    </div>

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row" id="productContainer">
                @forelse ($produk as $item)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 product-item-wrapper"
                        data-name="{{ strtolower($item->nama) }}"
                        data-category="{{ strtolower($item->category->nama ?? '') }}" data-aos="zoom-in">

                        <div class="product-item position-relative">
                            <a href="{{ route('detail-produk', $item->id) }}">
                                <img src="{{ $item->image1 ? asset('storage/' . $item->image1) : asset('images/product-placeholder.png') }}"
                                    class="img-fluid product-thumbnail rounded">

                                <h3 class="product-title">{{ $item->nama }}</h3>
                                <strong class="product-price">Rp{{ number_format($item->harga, 0, ',', '.') }}</strong>
                            </a>

                            <form action="{{ route('cart.add', $item->id) }}" method="POST"
                                class="position-absolute bottom-0 start-50 translate-middle-x" style="z-index: 2;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <input type="hidden" name="qty" id="inputQty" value="1">
                                <button type="submit" class="border-0 bg-transparent p-0 m-0">
                                    <span class="icon-cross">
                                        <img src="{{ asset('images/cross.svg') }}" class="img-fluid" alt="Add to Cart">
                                    </span>
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="col-12">
                        <p>No item available.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase().trim();
            let items = document.querySelectorAll('.product-item-wrapper');

            items.forEach(item => {
                let nama = item.dataset.name;
                let category = item.dataset.category;


                if (nama.includes(keyword) || category.includes(keyword)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
    </script>

@endsection
