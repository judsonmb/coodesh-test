<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\ProductImportHistoryController;

Route::prefix('v1')->group(function () {
    Route::get('', [ProductImportHistoryController::class, 'index']);

    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('{code}', [ProductController::class, 'show']);
        Route::put('{code}', [ProductController::class, 'update']);
        Route::delete('{code}', [ProductController::class, 'destroy']);
    });
});