@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

    <div class="container py-5">

        {{-- <h3 class="fw-bold mb-4 text-warning">Keranjang Belanja</h3> --}}

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @if (count($cart) > 0)

                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th class="text-nowrap">Price</th>
                                    <th class="text-nowrap">Quantity</th>
                                    <th class="text-nowrap">Subtotal</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cart as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->product->image1) }}"
                                                class="img-fluid rounded"
                                                style="width: 70px; height:70px; object-fit:cover;">
                                        </td>

                                        <td>
                                            <h6 class="mb-1">{{ $item->product->nama }}</h6>
                                            <small
                                                class="text-muted">{{ $item->product->category->nama ?? 'Kategori Produk' }}</small>
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">

                                                <button class="btn btn-outline-secondary btn-sm decrease"
                                                    data-id="{{ $item->id }}">−</button>

                                                <span class="px-2 fw-bold qty">{{ $item->qty }}</span>

                                                <button class="btn btn-outline-secondary btn-sm increase"
                                                    data-id="{{ $item->id }}">+</button>

                                            </div>
                                        </td>

                                        <td class="subtotal fw-bold">
                                            Rp {{ number_format($item->qty * $item->harga, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center fs-3 py-5 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" style="width: 30px; height:30px">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>

                        Keranjang kosong
                    </p>
                @endif

            </div>
        </div>

        @if (count($cart) > 0)
            <div class="row justify-content-end">
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Total Belanja</h5>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal:</span>
                                <span class="fw-bold text-black total">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                            <form action="{{ route('checkout') }}" method="GET">
                                @csrf

                                <button class="btn btn-black text-white w-100 fw-bold py-2">
                                    Pesan Sekarang
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        @endif

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            function updateCart(id, qty, qtyEl, subtotalEl) {
                $.post("{{ route('cart.updateQty') }}", {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    qty: qty
                }, function(data) {

                    qtyEl.text(qty);
                    subtotalEl.text("Rp " + data.subtotal);
                    $(".total").text("Rp " + data.total);

                });
            }

            $(".increase").click(function() {
                let id = $(this).data("id");
                let qtyEl = $(this).siblings(".qty");
                let qty = parseInt(qtyEl.text()) + 1;

                let subtotalEl = $(this).closest("tr").find(".subtotal");

                updateCart(id, qty, qtyEl, subtotalEl);
            });

            $(".decrease").click(function() {
                let id = $(this).data("id");
                let qtyEl = $(this).siblings(".qty");
                let qty = parseInt(qtyEl.text()) - 1;
                if (qty < 1) qty = 1;

                let subtotalEl = $(this).closest("tr").find(".subtotal");

                updateCart(id, qty, qtyEl, subtotalEl);
            });

        });
    </script>

@endsection
