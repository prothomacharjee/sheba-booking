<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AdminServiceController;

Route::middleware('auth:api')->prefix('admin')->group(function () {
    Route::get('/services', [AdminServiceController::class, 'index']);
    Route::post('/services', [AdminServiceController::class, 'store']);
    Route::put('/services/{service}', [AdminServiceController::class, 'update']);
    Route::delete('/services/{service}', [AdminServiceController::class, 'destroy']);
});
