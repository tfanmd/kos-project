<?php

use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/find-kos', [BoardingHouseController::class, 'find'])->name('find-kos');

Route::get('/check-booking', [BookingController::class, 'check'])->name('check-booking');