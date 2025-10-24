<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute publik (bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product}', [HomeController::class, 'show'])->name('product.show');


// Grup untuk semua rute yang WAJIB LOGIN
Route::middleware('auth')->group(function () {
    // Rute Bawaan Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Admin Produk
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    
    // Rute Checkout Pengguna
    Route::get('/checkout/{product}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Rute Detail Pesanan Pengguna
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    
    // Rute Manajemen Pesanan Admin
    Route::get('/admin/orders', [OrderController::class, 'indexAdmin'])->name('admin.orders.index');

    // Rute untuk menampilkan riwayat pesanan pengguna
    Route::get('/my-orders', [OrderController::class, 'indexUser'])->name('orders.index');

    // Rute untuk admin meng-update status pesanan
    Route::patch('/admin/orders/{order}/complete', [OrderController::class, 'complete'])->name('admin.orders.complete');

    // Rute untuk pengguna men-download file
    Route::get('/orders/{order}/download', [OrderController::class, 'download'])->name('orders.download');
});


// Bagian paling bawah, untuk rute login/register
require __DIR__.'/auth.php';