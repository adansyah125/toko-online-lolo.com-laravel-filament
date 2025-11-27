<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('about', [DashboardController::class, 'about'])->name('about');
Route::get('contact', [DashboardController::class, 'contact'])->name('contact');
Route::get('/produk', [ProdukController::class, 'index'])->name('shop');
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('detail-produk');


Route::middleware(['auth', 'onlyuser'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateQty'])->name('cart.updateQty');

    // Route::get('/order', [OrderController::class, 'order'])->name('checkout');
    Route::post('/order/add', [OrderController::class, 'store'])->name('pesanan.add');
    Route::get('/order', [OrderController::class, 'order'])->name('checkout');
    Route::post('get-regencie', [OrderController::class, 'getRegencie'])->name('get.regencie');
    Route::post('get-district', [OrderController::class, 'getDistrict'])->name('get.district');
    Route::post('get-village', [OrderController::class, 'getVillage'])->name('get.village');

    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/delete/{id}', [OrderController::class, 'delete'])->name('pesanan.delete');
    Route::get('/pesanan/{order_id}', [OrderController::class, 'viewPesanan'])->name('lihat-pesanan');
    Route::get('/pesanan/{order_id}/cetak', [OrderController::class, 'cetak'])
        ->name('order.cetak');

    Route::post('/payment/{order_id}/bayar', [PaymentController::class, 'bayar'])->name('pesanan.bayar');
    Route::post('/payment/{order_id}/lunas', [PaymentController::class, 'markAsLunas'])->name('payment.success');
    Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('midtrans.callback');

    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::put('/profile/update', [AuthController::class, 'profileUpdate'])->name('user.profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::middleware('guestuser')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('user.register.post');
    Route::post('validate/register', [AuthController::class, 'validateRegis'])->name('validate.register');
    Route::post('validate/login', [AuthController::class, 'validateLogin'])->name('validate.login');
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::get('/register', function () {
        return view('Auth.register');
    });
});


Route::get('/blog', function () {
    return view('page.blog');
});
