<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// ✅ Terima order dari HUB
Route::post('webhook/orders', [OrderController::class, 'receiveOrderFromHub']);

// ✅ Sinkron dari Hub ke Lokal (Webhook)
Route::post('/product/sync', [ProductController::class, 'syncManual']);

// ✅ Sinkronisasi produk dari Lokal ke Hub
Route::post('/products/{id}/sync-to-hub', [ProductController::class, 'syncProductToHub']);

// ✅ Toggle status lokal tanpa autentikasi (agar fetch JS bisa)
Route::put('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility']);

// ✅ Hapus produk dari Hub
Route::delete('/products/{product}/delete-from-hub', [ProductController::class, 'deleteProductFromHub']);
