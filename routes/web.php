<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Filament\Resources\UserResource;
use App\Http\Controllers\Pelanggan\CartController;
use App\Http\Controllers\Pelanggan\OrderController;
use App\Http\Controllers\Pelanggan\PaymentController;

Route::get('/', function () {
    $meja = \App\Models\Meja::query()->first(); // atau berdasarkan request / QR scan
    session(['nomor_meja' => $meja->nomor_meja]); // simpan ke session
    return redirect()->route('customer.index');
});

Route::get('/menu/{meja:nomor_meja?}', [CustomerController::class, 'index'])->name('customer.index');

// Route::controller(CustomerController::class)->group(function () {
//     Route::get('menu/{category?}', 'index')->name('customer.index');
//     // Route::get('cart', 'cart');
//     // Route::post('order', 'order');
//     Route::get('payment/{order}', 'payment');
//     Route::post('payment', 'handlePayment');
//     Route::get('receipt/{payment}', 'receipt');
// });

Route::controller(CartController::class)->group(function () {
    Route::get('cart', 'index')->name('cart.index');
    Route::post('cart/add/{menu}', 'add')->name('cart.add');
    Route::post('cart', 'update')->name('cart.update');
});

Route::get('/order', [OrderController::class, 'form'])->name('order');
Route::post('/order', [OrderController::class, 'store'])->name('order');
Route::get('/order/detail/{id}', [OrderController::class, 'showDetail'])->name('order.detail');

Route::get('/payment/{order}', [PaymentController::class, 'payWithXendit'])->name('payment.xendit');
// Route::post('/xendit/callback', [PaymentController::class, 'handleCallback']);

// Route::middleware(['auth', 'role:owner'])->group(function () {});
