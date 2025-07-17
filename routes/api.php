<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\OrderController;

// Untuk otentikasi pengguna API (pakai Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Produk (boleh diatur pakai middleware kalau perlu)
Route::get('/products', [ProductApiController::class, 'index']);
Route::put('/products/{id}/toggle', [ProductApiController::class, 'toggleActive']);

// Order masuk dari Hub (API eksternal)
Route::post('/order/receive', [OrderController::class, 'receiveFromHub']);
