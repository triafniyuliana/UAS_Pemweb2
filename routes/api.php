<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SyncHubController;
use App\Http\Controllers\ProductController;

Route::post('webhook/orders', [OrderController::class, 'receiveOrderFromHub']);

Route::put('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility']);
Route::post('/products/{product}/sync-to-hub', [ProductController::class, 'sync']); // ← Ganti ini
Route::delete('/products/{product}/delete-from-hub', [ProductController::class, 'deleteProductFromHub']);

Route::middleware('auth')->group(function () {
    // tambahkan route lain yang butuh auth di sini jika perlu
});
