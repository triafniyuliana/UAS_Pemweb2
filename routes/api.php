<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SyncHubController;

Route::post('webhook/orders', [OrderController::class, 'receiveOrderFromHub']);
Route::post('sync/category/{id}', [SyncHubController::class, 'syncCategory']);
Route::post('sync/product/{id}', [SyncHubController::class, 'syncProduct']);