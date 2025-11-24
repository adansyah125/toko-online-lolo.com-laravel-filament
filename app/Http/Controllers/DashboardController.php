<?php


namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $informasi = Informasi::latest()->take(1)->get();

        $unggulanProducts = Product::oldest()->take(3)->get();

        $hotDeals = Product::orderBy('harga', 'asc')->take(1)->get();
        $bestSeller = Product::orderBy('harga', 'desc')->take(1)->get();
        $featuredProducts = Product::where('harga', true)->get();
        return view('dashboard', compact('hotDeals', 'bestSeller', 'featuredProducts', 'informasi', 'unggulanProducts'));
    }

    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('page.contact');
    }
}
