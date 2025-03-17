<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ProductController;

Route::prefix('v1')->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('/products/{code}', [ProductController::class, 'show']);
    Route::put('products/{code}', [ProductController::class, 'update']);
});