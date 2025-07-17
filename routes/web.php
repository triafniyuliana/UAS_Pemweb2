<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CustomerAuthController;

// ------------------------------
// Halaman Customer / Tampilan Toko
// ------------------------------

Route::get('/', [StoreController::class, 'beranda'])->name('store.index');
Route::get('/contact', [StoreController::class, 'contact'])->name('store.contact');

// Urutan penting: yang lebih spesifik dulu
Route::get('/products/category/{name}', [StoreController::class, 'productsByCategory'])->name('store.products.category');
Route::get('/products', [StoreController::class, 'products'])->name('store.products');
Route::get('/products/{id}', [StoreController::class, 'showProduct'])->name('store.show'); // butuh ID!

// ------------------------------
// Autentikasi Customer
// ------------------------------

Route::get('/login-customer', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login-customer', [CustomerAuthController::class, 'login']);

Route::get('/register-customer', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/register-customer', [CustomerAuthController::class, 'register']);

Route::post('/logout-customer', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// ------------------------------
// Login Manual Admin (Opsional)
// ------------------------------

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ------------------------------
// Area Admin (Hanya untuk User Login)
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

    // Manajemen Data
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    // Sinkronisasi & Toggle Status (pastikan sebelum `resource`)
    Route::post('products/{product}/sync', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

    Route::post('categories/{category}/sync', [CategoryController::class, 'sync'])->name('categories.sync');
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');

    // Pesanan dari lokal
    Route::post('/orders/manual', [OrderController::class, 'storeFromLocal'])->name('orders.storeFromLocal');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ------------------------------
// Halaman Tambahan Opsional
// ------------------------------

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/test-env', function () {
    return response()->json([
        'CLIENT_ID' => env('CLIENT_ID'),
        'CLIENT_SECRET' => env('CLIENT_SECRET'),
    ]);
});

// ------------------------------
// Autentikasi Laravel Bawaan
// ------------------------------

require __DIR__ . '/auth.php';
