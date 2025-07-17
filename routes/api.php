<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductApiController;
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



Route::get('/products', [ProductApiController::class, 'index']);
Route::put('/products/{id}/toggle', [ProductApiController::class, 'toggleActive']);
Route::post('/order/receive', [OrderController::class, 'receiveFromHub']);


Route::middleware('auth')->group(function () {});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
