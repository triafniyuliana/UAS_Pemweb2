<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// ✅ Untuk menerima order dari Hub (Webhook)
Route::post('webhook/orders', [OrderController::class, 'receiveOrderFromHub']);

// ✅ Untuk sinkronisasi manual dari Hub ke Lokal
Route::post('/product/sync', [ProductController::class, 'syncManual']);

// ✅ Sinkronisasi produk lokal ke Hub → DIBUKA tanpa auth agar tombol bisa diakses
Route::post('/products/{id}/sync-to-hub', [ProductController::class, 'syncProductToHub']);

// ✅ Fitur yang butuh autentikasi (optional)
Route::middleware('auth')->group(function () {
    Route::put('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility']);
    Route::delete('/products/{product}/delete-from-hub', [ProductController::class, 'deleteProductFromHub']);
});
