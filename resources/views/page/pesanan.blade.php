@extends('layouts.app')

@section('content')
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 mt-8">

        <h2 class="text-2xl font-bold text-[#ff6f00] mb-4">Daftar Pesanan Saya</h2>

        <div class="bg-gray-100 p-4 sm:p-5 rounded-xl shadow overflow-x-auto">

            <table class="w-full border-collapse min-w-[750px] text-center">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-sm">
                        <th class="p-3 font-semibold">Nama Produk</th>
                        <th class="p-3 font-semibold">Order ID</th>
                        <th class="p-3 font-semibold">Total Harga</th>
                        <th class="p-3 font-semibold">Jumlah</th>
                        <th class="p-3 font-semibold">Kurir</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @forelse($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 font-medium">{{ $order->nama_produk }}</td>
                            <td class="p-3 text-gray-600">{{ $order->id }}</td>
                            <td class="p-3 text-[#ff6f00] font-semibold">Rp
                                {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td class="p-3 text-gray-600">{{ $order->qty }}</td>
                            <td class="p-3 text-gray-600">{{ $order->ekspedisi }}</td>
                            <td class="p-3">
                                @if ($order->status == 'pending')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold bg-yellow-300 text-yellow-800 rounded-full">Pending</span>
                                @elseif($order->status == 'success' || $order->status == 'berhasil')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold bg-green-300 text-green-800 rounded-full">Berhasil</span>
                                @elseif($order->status == 'canceled' || $order->status == 'dibatalkan')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold bg-red-600 text-red-800 rounded-full">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if ($order->status == 'pending')
                                    <a href=""
                                        class="px-3 py-2 bg-[#ff6f00] text-white rounded-lg text-xs sm:text-sm hover:bg-[#cc5200] transition shadow mr-1">Bayar
                                        Sekarang</a>
                                    <a href=""
                                        class="px-3 py-2 bg-red-500 text-white rounded-lg text-xs sm:text-sm hover:bg-red-700 transition shadow">Batalkan</a>
                                @elseif($order->status == 'success' || $order->status == 'berhasil')
                                    <a href=""
                                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg text-xs sm:text-sm hover:bg-yellow-600 transition shadow">Lihat
                                        Pesanan</a>
                                @else
                                    <span class="text-gray-400 text-xs">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-gray-500 py-4">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </section>
@endsection
