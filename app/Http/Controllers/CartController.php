<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []); // Ambil cart dari session
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('page.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty ?? 1;

        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'name' => $product->nama,
                'price' => $product->harga,
                'qty' => $qty,
                'image' => $product->image1,
            ];
        }

        session()->put('cart', $cart);

        return redirect('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateQty(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
            session()->put('cart', $cart);
        }

        $subtotal = $cart[$id]['price'] * $qty;
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return response()->json([
            'subtotal' => number_format($subtotal, 0, ',', '.'),
            'total' => number_format($total, 0, ',', '.')
        ]);
    }


    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
