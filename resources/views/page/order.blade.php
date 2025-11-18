@extends('layouts.app')

@section('content')
    <section class="max-w-[1200px] mx-auto px-4 sm:px-6 mt-8">

        <h2 class="text-2xl font-bold text-[#ff6f00] mb-6">Checkout Pesanan</h2>

        @if (count($cart) > 0)
            {{-- TAMPILKAN PRODUK --}}
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-5 mb-6">
                <h3 class="text-lg font-semibold mb-4">Produk yang dipesan</h3>
                <div class="space-y-4">
                    @foreach ($cart as $id => $item)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <p class="font-semibold">{{ $item['name'] }}</p>
                                    <p class="text-gray-500">Qty: {{ $item['qty'] }}</p>
                                </div>
                            </div>
                            <div class="font-semibold text-[#ff6f00]">Rp
                                {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center mt-4 font-semibold text-lg">
                    <span>Total:</span>
                    <span class="text-[#ff6f00]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- FORM CHECKOUT --}}
            <form action="{{ route('pesanan.add') }}" method="POST" class="space-y-6 bg-white rounded-xl shadow-md p-6">
                @csrf
                <h3 class="text-lg font-semibold mb-4">Informasi Penerima</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium">Nama Penerima</label>
                        <input type="text" name="nama_penerima" required
                            class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-[#ff6f00]">
                    </div>
                    <div>
                        <label class="text-sm font-medium">No. Telepon</label>
                        <input type="text" name="telepon" required
                            class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-[#ff6f00]">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required
                            class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-[#ff6f00]"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Kota/Kabupaten</label>
                        <input type="text" name="kota" required
                            class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-[#ff6f00]">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Kode Pos</label>
                        <input type="text" name="kode_pos" required
                            class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-[#ff6f00]">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium">Pilih Ekspedisi</label>
                    <select name="ekspedisi"
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-[#ff6f00]">
                        <option value="JNE">JNE - Reguler</option>
                        <option value="J&T">J&T - EZ</option>
                        <option value="SiCepat">SiCepat - BEST</option>
                        <option value="AnterAja">AnterAja - Reguler</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-[#ff6f00] text-white rounded-xl font-semibold hover:bg-[#cc5200]">
                        Buat Pesanan
                    </button>
                </div>
            </form>
        @else
            <p class="text-center text-gray-500 py-10">Keranjang kosong</p>
        @endif

    </section>

    {{-- TOAST NOTIF --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('error') }}
        </div>
    @endif
@endsection
