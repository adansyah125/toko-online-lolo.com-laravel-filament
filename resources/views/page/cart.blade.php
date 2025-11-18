@extends('layouts.app')

@section('content')
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 mt-8 pb-20">

        <h2 class="text-2xl font-bold text-[#ff6f00] mb-4">Keranjang Belanja</h2>

        <div class="bg-white rounded-xl shadow-md p-4 sm:p-5">

            @if (count($cart) > 0)
                <div class="space-y-4">
                    @foreach ($cart as $id => $item)
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 pb-4 border-b">

                            <img src="{{ asset('storage/' . $item['image']) }}"
                                class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg object-cover shadow">

                            <div class="flex-1">
                                <h3 class="font-semibold text-base sm:text-lg leading-tight">{{ $item['name'] }}</h3>
                                <p class="text-gray-500 text-sm">{{ $item['category'] ?? 'Kategori Produk' }}</p>
                                <p class="text-[#ff6f00] font-bold text-base sm:text-lg mt-1">Rp
                                    {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>

                            <div class="flex items-center gap-2">
                                <button
                                    class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300 decrease"
                                    data-id="{{ $id }}">−</button>
                                <span class="w-7 sm:w-8 text-center qty">{{ $item['qty'] }}</span>
                                <button
                                    class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300 increase"
                                    data-id="{{ $id }}">+</button>
                            </div>

                            <div class="text-right ml-auto sm:ml-0">
                                <p class="font-semibold text-sm sm:text-base subtotal">Rp
                                    {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 text-xs sm:text-sm mt-1 hover:underline">Hapus</button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-10">Keranjang kosong</p>
            @endif

        </div>

        @if (count($cart) > 0)
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-5 mt-6">
                <div class="flex justify-between items-center text-base sm:text-lg font-semibold">
                    <span>Total</span>
                    <span class="text-[#ff6f00] total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('checkout') }}" method="get">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $id }}">
                    <input type="hidden" name="qty" value="{{ $item['qty'] }}">

                    <!-- Data penerima bisa ditambahkan di halaman order / checkout -->

                    <button type="submit"
                        class="w-full mt-4 block bg-[#ff6f00] text-white py-3 rounded-xl text-lg font-semibold shadow hover:bg-[#e65c00] text-center">
                        Pesan Sekarang
                    </button>
                </form>
            </div>
        @endif

    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            function updateCart(id, qty, spanQty, subtotalEl) {
                $.post("{{ route('cart.updateQty') }}", {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    qty: qty
                }, function(data) {
                    // update qty dan subtotal
                    spanQty.text(qty);
                    subtotalEl.text('Rp ' + data.subtotal);

                    // update total
                    $('.total').text('Rp ' + data.total);
                });
            }

            $('.increase').click(function() {
                let id = $(this).data('id');
                let qtyEl = $(this).siblings('.qty');
                let qty = parseInt(qtyEl.text()) + 1;
                let subtotalEl = $(this).closest('.flex').siblings('.text-right').find('.subtotal');

                updateCart(id, qty, qtyEl, subtotalEl);
            });

            $('.decrease').click(function() {
                let id = $(this).data('id');
                let qtyEl = $(this).siblings('.qty');
                let qty = parseInt(qtyEl.text()) - 1;
                if (qty < 1) qty = 1; // minimal 1
                let subtotalEl = $(this).closest('.flex').siblings('.text-right').find('.subtotal');

                updateCart(id, qty, qtyEl, subtotalEl);
            });

        });
    </script>


@endsection
