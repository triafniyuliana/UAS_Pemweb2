<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\HomeController;

// ------------------------------
// Tampilan Toko (Customer)
// ------------------------------

Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/produk/{slug}', [StoreController::class, 'show'])->name('store.show');
Route::get('/kategori/{slug}', [StoreController::class, 'category'])->name('store.category');

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

    Route::post('products/sync/{id}', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('category/sync/{id}', [CategoryController::class, 'sync'])->name('category.sync');
});

// ------------------------------
// Autentikasi Laravel (register, dll)
// ------------------------------

require __DIR__ . '/auth.php';
