<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', auth()->id())->get();

        $total = $cart->sum(fn($c) => $c->qty * $c->harga);

        return view('page.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty ?? 1;

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menambah ke keranjang.');
        }

        $userId = auth()->id();

        // cek apakah produk sudah ada di cart
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // update qty 
            $cartItem->qty += $qty;
            $cartItem->save();
        } else {

            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'qty' => $qty,
                'harga' => $product->harga,
            ]);
        }


        Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Add to cart',
            'deskripsi' => "Memesan Barang: $product->nama (Add to Cart)",
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect('/cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateQty(Request $request)
    {
        $cart = Cart::where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cart->qty = $request->qty;
        $cart->save();

        // hitung subtotal
        $subtotal = number_format($cart->qty * $cart->harga, 0, ',', '.');

        // hitung total baru
        $total = Cart::where('user_id', auth()->id())
            ->get()
            ->sum(fn($c) => $c->qty * $c->harga);

        return response()->json([
            'subtotal' => $subtotal,
            'total' => number_format($total, 0, ',', '.'),
        ]);
    }



    public function remove($id)
    {
        Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
