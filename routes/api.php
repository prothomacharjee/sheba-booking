<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BookingController;

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
