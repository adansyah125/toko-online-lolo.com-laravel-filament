<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Informasi terbaru
        $informasi = Informasi::latest()->take(1)->get();

        // Produk unggulan: harga paling murah, 4 data
        $featuredProducts = Product::orderBy('harga', 'asc')->take(4)->get();

        return view('dashboard', compact('informasi', 'featuredProducts'));
    }
}
