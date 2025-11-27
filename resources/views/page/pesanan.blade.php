@extends('layouts.app')

@section('content')
    <section class="container mt-4 mb-5">

        {{-- <h2 class="fw-bold text-secondary">Daftar Pesanan Saya</h2> --}}

        <div class="">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th>Kode Pesanan</th>
                                        <th>Nama Produk</th>
                                        <th class="text-nowrap">Total Harga</th>
                                        <th class="text-nowrap">Jumlah</th>
                                        <th>Status</th>
                                        <th>Pengiriman</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse($orders as $order)
                                        <tr class="border-0" style="transition: 0.2s;">

                                            <td class="text-muted py-3">{{ $order->order_id }}</td>
                                            <td class="fw-semibold py-3">{{ $order->nama_produk }}</td>


                                            <td class="fw-bold text-black py-3">
                                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                            </td>

                                            <td class="text-muted py-3">{{ $order->qty }}</td>


                                            <td class="py-3">
                                                @if ($order->status == 'pending')
                                                    <span
                                                        class="badge rounded-pill text-warning text-dark px-3 py-2">Pending</span>
                                                @elseif($order->status == 'paid' || $order->status == 'berhasil')
                                                    <span class="badge rounded-pill text-success px-3 py-2">Berhasil</span>
                                                @elseif($order->status == 'failed' || $order->status == 'dibatalkan')
                                                    <span class="badge rounded-pill text-danger px-3 py-2">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->payment)
                                                    @php $pay = $order->payment->first(); @endphp
                                                    @if ($pay->order_status == 'proses')
                                                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                                                            Diproses</span>
                                                    @elseif($pay->order_status == 'kirim')
                                                        <span class="badge rounded-pill bg-info text-dark px-3 py-2">Sedang
                                                            Dikirim</span>
                                                    @elseif($pay->order_status == 'selesai')
                                                        <span class="badge rounded-pill bg-success px-3 py-2">Selesai</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-secondary px-3 py-2">-</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            {{-- {{ dd($order->payment) }} --}}
                                            <td class="py-3">
                                                @if ($order->status == 'pending')
                                                    <a href="{{ route('lihat-pesanan', $order->order_id) }}"
                                                        class="badge text-dark px-3 py-2 hover:bg-warning/80 hover:text-white"
                                                        style="text-decoration: none;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="text-warning" style="width: 15px; height:15px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        Lihat Pesanan</a>
                                                    <a href="#"
                                                        onclick="confirmCancel('{{ $order->order_id }}', '{{ route('pesanan.delete', $order->id) }}')"
                                                        class="badge
                                                        text-dark px-3 py-2 hover:bg-warning/80 hover:text-white"
                                                        style="text-decoration: none;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="text-danger" style="width: 15px; height:15px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        Batalkan
                                                    </a>
                                                    {{-- @elseif($order->status == 'paid' || $order->status == 'berhasil') --}}
                                                @else
                                                    <a href="{{ route('lihat-pesanan', $order->order_id) }}"
                                                        class="badge text-dark px-3 py-2 hover:bg-warning/80 hover:text-white"
                                                        style="text-decoration: none;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="text-warning" style="width: 15px; height:15px">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        Lihat Pesanan</a>
                                                @endif
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                Belum ada pesanan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '{!! implode('<br>', $errors->all()) !!}',
            });
        </script>
    @endif
@endsection
<script>
    function confirmCancel(orderId, url) {
        Swal.fire({
            title: "Batalkan Pesanan?",
            html: "Pesanan dengan kode <b>" + orderId + "</b> akan dibatalkan?",
            icon: "warning",

            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, batalkan!",
            cancelButtonText: "Tidak",

            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
