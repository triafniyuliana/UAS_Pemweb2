<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SyncHubController;
use App\Http\Controllers\ProductController;

Route::post('webhook/orders', [OrderController::class, 'receiveOrderFromHub']);
Route::post('sync/category/{id}', [SyncHubController::class, 'syncCategory']);
Route::post('sync/product/{id}', [SyncHubController::class, 'syncProduct']);

Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products/{product}/sync-to-hub', [ProductController::class, 'syncProductToHub']);
    Route::put('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility']);
    Route::delete('/products/{product}/delete-from-hub', [ProductController::class, 'deleteProductFromHub']);
});