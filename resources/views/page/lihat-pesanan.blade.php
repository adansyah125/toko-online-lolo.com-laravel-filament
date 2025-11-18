@extends('layouts.app')

@section('content')
    <section class="pb-12">
        <div class="max-w-4xl mx-auto mt-8 p-6  bg-white shadow-lg rounded-lg">

            {{-- HEADER --}}
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
                <p class="text-gray-500 text-sm">Kode Pesanan: <span class="font-semibold text-gray-700">ORD-77401</span></p>
            </div>

            <div class="border rounded-lg overflow-hidden">

                {{-- STATUS PESANAN --}}
                <div class="p-4 bg-gray-50 border-b">
                    <span class="px-3 py-1 bg-green-200 text-green-800 font-semibold text-xs rounded-full">
                        Sudah Dibayar
                    </span>
                </div>

                {{-- DETAIL PRODUK --}}
                <div class="p-4 border-b">
                    <h2 class="font-semibold text-gray-700 mb-3">Produk</h2>

                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80"
                            class="w-20 h-20 rounded-lg object-cover">

                        <div>
                            <p class="font-semibold text-gray-800">Produk Fashion</p>
                            <p class="text-sm text-gray-500">Jumlah: 2</p>
                            <p class="text-sm text-[#ff6f00] font-semibold mt-1">Rp 350.000</p>
                        </div>
                    </div>
                </div>

                {{-- INFORMASI PENGIRIMAN --}}
                <div class="p-4 border-b">
                    <h2 class="font-semibold text-gray-700 mb-2">Informasi Pengiriman</h2>

                    <p class="text-sm text-gray-600"><strong>Nama:</strong> Syahdan Mutahariq</p>
                    <p class="text-sm text-gray-600"><strong>Alamat:</strong> Jl. Cicukang RT 2 RW 28, Kab Bandung Kec
                        Margaasih Desa Mekarrahayu 40218 Dekat Lapang Lebak</p>
                    <p class="text-sm text-gray-600"><strong>Kurir:</strong> JNE Reguler</p>
                    <p class="text-sm text-gray-600"><strong>No. Resi:</strong> 12345ABC678</p>
                </div>

                {{-- RINGKASAN PEMBAYARAN --}}
                <div class="p-4 border-b">
                    <h2 class="font-semibold text-gray-700 mb-3">Ringkasan Pembayaran</h2>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-800">Rp 700.000</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="font-semibold text-gray-800">Rp 20.000</span>
                        </div>

                        <div class="flex justify-between border-t pt-2 mt-2">
                            <span class="text-gray-700 font-semibold">Total</span>
                            <span class="text-[#ff6f00] font-bold">Rp 720.000</span>
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="p-4 flex justify-end bg-gray-50">
                    <a href="pesanan"
                        class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm hover:bg-gray-900 transition shadow">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection
