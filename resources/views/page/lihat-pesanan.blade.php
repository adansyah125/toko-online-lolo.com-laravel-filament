@extends('layouts.app')

@section('content')
    <section class="pb-5">
        <div class="container mt-5">

            <div class="mx-auto p-4 p-md-5 bg-white shadow rounded-4" style="max-width: 1200px;">

                {{-- HEADER --}}
                <div class="mb-4">
                    <h1 class="fw-bold text-dark fs-3">Detail Pesanan</h1>
                    <p class="text-secondary small">
                        Kode Pesanan:
                        <span class="fw-semibold text-dark">{{ $order->order_id }}</span>
                    </p>
                </div>

                <div class="border rounded-4 overflow-hidden">

                    {{-- STATUS PESANAN --}}
                    <div class="p-3 bg-light border-bottom">
                        @if ($order->status == 'pending')
                            <span class="badge bg-danger px-3 py-2">Menunggu Pembayaran</span>
                        @elseif ($order->status == 'paid')
                            <span class="badge bg-success px-3 py-2">Pembayaran Diterima</span>
                        @endif
                    </div>

                    {{-- DETAIL PRODUK --}}
                    <div class="p-4 border-bottom bg-white">
                        <h5 class="fw-semibold text-secondary mb-3">Produk</h5>

                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/' . $order->product->image1) }}" class="rounded-3 shadow-sm"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            {{-- <td>{{ dd($order->product) }}</td> --}}

                            <div>
                                <p class="fw-semibold text-dark mb-1">{{ $order->nama_produk }}</p>
                                <p class="text-muted small mb-1">Jumlah: {{ $order->qty }}</p>
                                <p class="text-black fw-bold small mb-0">Rp {{ number_format($order->total_harga, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- INFORMASI PENGIRIMAN --}}
                    <div class="p-4 border-bottom bg-light">
                        <h5 class="fw-semibold text-secondary mb-3">Informasi Pengiriman</h5>

                        <p class="small text-dark"><strong>Nama:</strong> {{ $order->nama_penerima }}</p>
                        <p class="small text-dark"><strong>Alamat:</strong>
                            {{ $order->alamat }}
                        </p>
                        <p class="small text-dark"><strong>Kurir:</strong> {{ $order->ekspedisi }}</p>
                        <p class="small text-dark"><strong>Status:</strong> {{ $order->status }}</p>
                    </div>

                    {{-- RINGKASAN PEMBAYARAN --}}
                    <div class="p-4 border-bottom bg-white">
                        <h5 class="fw-semibold text-secondary mb-3">Ringkasan Pembayaran</h5>

                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold text-dark">Rp {{ number_format($order->total_harga, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between small mb-2">
                            <span class="text-muted">Diskon</span>
                            <span class="fw-semibold text-dark">-</span>
                        </div>

                        <div class="border-top pt-2 mt-2 d-flex justify-content-between small">
                            <span class="fw-semibold text-dark">Total</span>
                            <span class="fw-bold text-black fs-6">Rp {{ number_format($order->total_harga, 2) }}</span>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    @if ($order->status == 'paid')
                        <div class="p-3 bg-light text-end">
                            <a href="{{ route('pesanan') }}" class="btn btn-dark btn-sm px-4 py-2 shadow-sm rounded-3">
                                kembali
                            </a>
                        </div>
                    @else
                        <div class="p-3 bg-light text-end">
                            <button id="pay-button" class="btn btn-dark btn-sm px-4 py-2 shadow-sm rounded-3">
                                Bayar
                            </button>
                        </div>
                    @endif


                </div>
            </div>

        </div>
    </section>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>


    <script>
        document.getElementById('pay-button').onclick = function() {
            fetch("/payment/{{ $order->order_id }}/bayar", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.snapToken) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Membuat Transaksi',
                            text: data.error || 'Token pembayaran tidak ditemukan.',
                            confirmButtonColor: '#3085d6',
                        });
                        return;
                    }

                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            fetch("/payment/{{ $order->order_id }}/lunas", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                }
                            }).then(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pembayaran Berhasil!',
                                    text: 'Pembayaran {{ $order->order_id }} dengan nominal Rp {{ number_format($order->total_harga, 2) }} telah berhasil diproses. Terima kasih.',
                                    confirmButtonColor: '#3085d6',
                                }).then(() => {
                                    window.location.href =
                                        "{{ route('lihat-pesanan', $order->order_id) }}";
                                });
                            });
                        },
                        onPending: function(result) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Menunggu Pembayaran',
                                text: 'Silakan selesaikan pembayaranmu untuk melanjutkan.',
                                confirmButtonColor: '#3085d6',
                            });
                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Membayar',
                                text: 'Terjadi kesalahan saat memproses pembayaran anda. Silakan coba lagi.',
                                confirmButtonColor: '#d33',
                            });
                        },
                        onClose: function() {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Pembayaran Dibatalkan',
                                text: 'Kamu menutup pembayaran. Silakan coba lagi.',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                window.location.href =
                                    "{{ route('lihat-pesanan', $order->order_id) }}";
                            });
                        }
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: error.message,
                        confirmButtonColor: '#d33',
                    });
                });
        };
    </script>
@endsection
