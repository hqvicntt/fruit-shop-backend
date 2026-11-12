<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Routes for fetching the list and creating new products
Route::apiResource('products', ProductController::class);

// Routes for managing orders and daily revenue
Route::apiResource('orders', OrderController::class);
