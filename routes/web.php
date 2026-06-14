<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::post('/reservations', [FrontendController::class, 'storeReservation'])->name('reservations.store');
Route::get('/checkout/{order}', [CheckoutController::class, 'prosesBayar'])->name('checkout');
Route::post('/midtrans-callback', [CheckoutController::class, 'webhook']);
Route::post('/checkout/{order}/bayar-kasir', [CheckoutController::class, 'bayarDiKasir'])->name('checkout.kasir');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{menuId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');