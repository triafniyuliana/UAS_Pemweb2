<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

// ------------------------------
// Tampilan Toko (Customer)
// ------------------------------

Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/produk/{slug}', [StoreController::class, 'show'])->name('store.show');
Route::get('/kategori/{slug}', [StoreController::class, 'category'])->name('store.category');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/checkout', [CartController::class, 'showCheckoutForm'])->name('cart.checkout.form');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// ------------------------------
// Halaman Welcome (Opsional)
// ------------------------------

Route::get('/welcome', function () {
    return view('welcome');
});

// ------------------------------
// Login Manual
// ------------------------------

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ------------------------------
// Area Admin (Butuh Login)
// ------------------------------

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen CRUD
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    // ✅ Sinkronisasi Produk ke Hub (gunakan tombol ON/OFF di web)
    Route::post('/products/{id}/sync', [ProductController::class, 'sync'])->name('products.sync');

    // ✅ Sinkronisasi Kategori ke Hub (jika pakai tombol)
    Route::post('/category/sync/{id}', [CategoryController::class, 'sync'])->name('category.sync');

    // ✅ (Jika masih pakai fitur visibilitas lokal — tapi kamu sekarang tidak pakai)
    // Hapus route ini kalau sudah tidak gunakan `is_visible` untuk toggle
    // Route::post('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility'])->name('products.toggleVisibility');

    // Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/manual', [OrderController::class, 'storeFromLocal'])->name('orders.storeFromLocal');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::get('/test-env', function () {
    return response()->json([
        'CLIENT_ID' => env('CLIENT_ID'),
        'CLIENT_SECRET' => env('CLIENT_SECRET'),
    ]);
});

// ------------------------------
// Autentikasi Laravel (register, dll)
// ------------------------------

require __DIR__ . '/auth.php';
