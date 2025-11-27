<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Transaksi</h2>

    <p>
        Periode:
        {{ $start ?? '-' }} s/d {{ $end ?? '-' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Pembeli</th>
                <th>Kode Pesanan</th>
                <th>Status Pembayaran</th>
                <th>Status Pesanan</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $p)
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->order_id }}</td>
                    <td>{{ $p->payment_status }}</td>
                    <td>{{ $p->order_status }}</td>
                    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
