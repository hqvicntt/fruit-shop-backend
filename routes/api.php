<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WebhookController;

// Routes for fetching the list and creating new products
Route::apiResource('products', ProductController::class);

// Routes for managing orders and daily revenue
Route::apiResource('orders', OrderController::class);

// Webhook endpoint for SePay
Route::post('webhook/sepay', [WebhookController::class, 'handleSepayWebhook']);

// Polling endpoint for Flutter mobile app
Route::get('check-payment', [WebhookController::class, 'checkPaymentStatus']);
