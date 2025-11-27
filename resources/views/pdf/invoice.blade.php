<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Detail Pesanan - {{ $order->order_id }}</title>

    <style>
        body {
            font-family: 'glyphicons-halflings', sans-serif;
            background: #f8f9fa;
            font-size: 12px;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
            color: white;
        }

        .badge-danger {
            background: #dc3545;
        }

        .badge-success {
            background: #28a745;
        }

        .badge-warning {
            background: #ffc107;
            color: #000;
        }

        .badge-info {
            background: #0dcaf0;
            color: #000;
        }

        .row {
            margin-bottom: 10px;
        }

        .img-product {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .flex {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .text-muted {
            color: #6c757d;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 10px 0;
        }

        .d-flex-between {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            {{-- HEADER --}}
            <div>
                <div class="title">Detail Pesanan</div>
                <div class="subtitle">
                    Kode Pesanan:
                    <strong>{{ $order->order_id }}</strong>
                </div>
            </div>

            {{-- STATUS --}}
            <div class="row">
                @if ($order->status == 'pending')
                    <span class="badge badge-danger">Menunggu Pembayaran</span>
                @elseif ($order->status == 'paid')
                    <span class="badge badge-success">Pembayaran Diterima</span>
                @endif
            </div>

            <br>

            {{-- PRODUK --}}
            <div>
                <div class="section-title">Produk</div>

                <div class="flex">
                    <img src="{{ public_path('storage/' . $order->product->image1) }}" class="img-product">

                    <div>
                        <div><strong>{{ $order->nama_produk }}</strong></div>
                        <div class="text-muted">Jumlah: {{ $order->qty }}</div>
                        <div><strong>Rp {{ number_format($order->total_harga, 2) }}</strong></div>
                    </div>
                </div>
            </div>

            <br>

            {{-- ALAMAT --}}
            <div>
                <div class="section-title">Informasi Pengiriman</div>

                <div class="row"><strong>Nama Penerima:</strong> {{ $order->nama_penerima }}</div>
                <div class="row"><strong>Telepon:</strong> {{ $order->no_telp }}</div>
                <div class="row"><strong>Alamat:</strong> {{ $order->alamat }}</div>
                <div class="row"><strong>Status:</strong> {{ $order->status }}</div>

                @php $pay = $order->payment->first(); @endphp
                <div class="row"><strong>Pengiriman:</strong> {{ $pay->order_status }}</div>
            </div>

            <br>

            {{-- RINGKASAN --}}
            <div>
                <div class="section-title">Ringkasan Pembayaran</div>

                <div class="d-flex-between">
                    <span class="text-muted">Subtotal</span>
                    <strong>Rp {{ number_format($order->total_harga, 2) }}</strong>
                </div>

                <div class="d-flex-between">
                    <span class="text-muted">Diskon</span>
                    <span>-</span>
                </div>

                <div class="divider"></div>

                <div class="d-flex-between">
                    <strong>Total</strong>
                    <strong>Rp {{ number_format($order->total_harga, 2) }}</strong>
                </div>
            </div>

        </div>

    </div>

</body>

</html>
