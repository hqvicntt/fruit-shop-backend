<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\AuthController;

// Public routes (No login required for Mobile App & SePay Webhook)
Route::post('login', [AuthController::class, 'login']);
Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::put('products/{product}', [ProductController::class, 'update']);
Route::delete('products/{product}', [ProductController::class, 'destroy']);
Route::post('orders', [OrderController::class, 'store']);
Route::post('webhook/sepay', [WebhookController::class, 'handleSepayWebhook']);
Route::get('check-payment', [WebhookController::class, 'checkPaymentStatus']);
Route::get('orders', [OrderController::class, 'index']);

// Protected routes (Requires Admin Token via Laravel Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
