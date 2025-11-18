<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        // Ambil semua order milik user yang sedang login
        // $orders = Order::where('user_id', auth()->id())->latest()->get();
        $orders = Order::latest()->get();

        return view('page.pesanan', compact('orders'));
    }
    public function order()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['qty'] * $item['price'];
        }

        return view('page.order', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (count($cart) == 0) {
            return redirect()->back()->with('error', 'Keranjang kosong');
        }

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan');
            }

            if ($item['qty'] > $product->stok) {
                return redirect()->back()->with('error', "Stok untuk produk {$product->name} tidak cukup");
            }
        }

        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            Order::create([
                'product_id'    => $id,
                'nama_produk'   => $product->nama,
                'qty'           => $item['qty'],
                'total_harga'   => $item['qty'] * $product->harga,
                'nama_penerima' => $request->nama_penerima,
                'no_telp'       => $request->telepon,
                'alamat'        => $request->alamat . ', ' . $request->kota . ', ' . $request->kode_pos,
                'ekspedisi'     => $request->ekspedisi,
                'status'        => 'pending',
            ]);

            $product->decrement('stok', $item['qty']);
        }

        session()->forget('cart');

        return redirect('pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }
}
