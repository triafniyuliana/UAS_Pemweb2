<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Login manual (jika kamu pakai LoginController sendiri)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard setelah login
Route::middleware(['auth'])->group(function () {

    // Dashboard halaman utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Kategori
    Route::resource('categories', CategoryController::class);

    // CRUD Produk
    Route::resource('products', ProductController::class);

    // CRUD Pesanan
    Route::resource('orders', OrderController::class);
});

// Otentikasi default Laravel Breeze
require __DIR__.'/auth.php';