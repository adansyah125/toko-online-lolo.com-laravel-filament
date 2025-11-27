<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Regency;
use App\Models\Village;
use App\Models\Activity;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('page.pesanan', compact('orders',));
    }

    public function viewPesanan($order_id)
    {
        $order = Order::where('order_id', $order_id)->firstOrFail();

        return view('page.lihat-pesanan', compact('order'));
    }
    public function order()
    {
        $provinces = Province::all();
        $regencies = Regency::all();
        $cart = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        // Hitung total
        $total = $cart->sum(function ($item) {
            return $item->qty * $item->harga;
        });

        $orderid = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));


        return view('page.order', compact('cart', 'total', 'orderid', 'provinces', 'regencies'));
    }


    public function store(Request $request)
    {

        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong');
        }

        // Cek stok untuk tiap item
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if (!$product) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan');
            }

            if ($item->qty > $product->stok) {
                return redirect()->back()->with('error', "Stok untuk produk {$product->nama} tidak cukup");
            }
        }



        // Proses setiap item di cart
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $provinceName = Province::where('id', $request->province)->value('name');
            $regencyName  = Regency::where('id', $request->regency)->value('name');
            $districtName = District::where('id', $request->district)->value('name');
            $villagename = Village::where('id', $request->village)->value('name');

            Order::create([
                'user_id'       => Auth::id(),
                'product_id'    => $product->id,
                'order_id'      => $request->order_id,
                'nama_produk'   => $product->nama,
                'qty'           => $item->qty,
                'total_harga'   => $item->qty * $product->harga,
                'nama_penerima' => $request->nama_penerima,
                'no_telp'       => $request->telepon,
                'alamat'        => $request->alamat . ', '
                    . $provinceName
                    . $regencyName . ', '
                    . $districtName . ', '
                    . $villagename . ', '
                    . $request->kode_pos,
                'status'        => 'pending',
            ]);

            $product->decrement('stok', $item->qty);

            // Hapus item cart setelah dibuat order
            $item->delete();
        }

        Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Checkout',
            'deskripsi' => "Membuat Pesanan ID: {$request->order_id}",
            'created_at' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect('pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }



    public function delete($id)
    {
        // Ambil pesanan
        $order = Order::find($id);

        if (!$order) {
            return redirect('pesanan')->with('error', 'Pesanan tidak ditemukan!');
        }

        // Ambil produk dari order
        $product = Product::find($order->product_id);

        // Kembalikan stok jika produk ditemukan
        if ($product) {
            $product->increment('stok', $order->qty);
        }

        $order->delete();

        return redirect('pesanan')->with('success', "Pesanan dengan kode <b>" + $order->order_id + "</b> Berhasil Dibatalkan");
    }


    public function getRegencie(Request $request)
    {
        $id_province = $request->id_province;

        $regencies = Regency::where('province_id', $id_province)->get();

        $option = "<option>Pilih Kab/Kota</option>";
        foreach ($regencies as $regencie) {
            $option .= "<option value='$regencie->id'>$regencie->name</option>";
        }

        echo $option;
    }

    public function getDistrict(Request $request)
    {
        $id_regencie = $request->id_regencie;

        $districts = District::where('regency_id', $id_regencie)->get();

        $option = "<option>Pilih Kecamatan</option>";
        foreach ($districts as $district) {
            $option .= "<option value='$district->id'>$district->name</option>";
        }

        echo $option;
    }


    public function getVillage(Request $request)
    {
        $id_district = $request->id_district;

        $villages = Village::where('district_id', $id_district)->get();

        $option = "<option>Pilih Kelurahan/Desa</option>";
        foreach ($villages as $village) {
            $option .= "<option value='$village->id'>$village->name</option>";
        }

        echo $option;
    }


    public function cetak($order_id)
    {
        $order = Order::with('product', 'payment')->where('order_id', $order_id)->firstOrFail();

        $pdf = Pdf::loadView('pdf.invoice', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('invoice-' . $order_id . '.pdf');
    }
}
