<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Product::with('Category')->paginate(10);
        $kategori = Category::all();
        return view('page.produk', compact('produk', 'kategori'));
    }


    public function detail($id)
    {
        $detail = Product::with('Category')->findOrFail($id);

        $relatedProducts = Product::where('category_id', $detail->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
        return view('page.detail-produk', compact('detail', 'relatedProducts'));
    }
}
