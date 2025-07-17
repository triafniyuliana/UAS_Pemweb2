<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CustomerAuthController;

// ------------------------------
// Tampilan Toko (Customer)
// ------------------------------

Route::get('/', [StoreController::class, 'beranda'])->name('store.index');
Route::get('/products', [StoreController::class, 'products'])->name('store.products');
Route::get('/products/{id}', [StoreController::class, 'showProduct'])->name('store.show');
Route::get('/products/category/{name}', [StoreController::class, 'productsByCategory'])->name('store.products.category');
Route::get('/contact', [StoreController::class, 'contact'])->name('store.contact');

//tampilan login dan register customer
Route::get('/login-customer', [CustomerAuthController::class, 'showLoginForm']);
Route::post('/login-customer', [CustomerAuthController::class, 'login']);

Route::get('/register-customer', [CustomerAuthController::class, 'showRegisterForm']);
Route::post('/register-customer', [CustomerAuthController::class, 'register']);

Route::post('/logout-customer', [CustomerAuthController::class, 'logout'])->name('customer.logout');


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

Route::prefix('admin')->middleware(['auth'])->group(function () {

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

    // Sinkronisasi dan toggle status (pastikan sebelum resource!)
    Route::post('products/{product}/sync', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');
    Route::post('categories/{category}/sync', [CategoryController::class, 'sync'])->name('categories.sync');
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
