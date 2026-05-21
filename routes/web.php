<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('customers', CustomerController::class);

Route::resource('rooms', RoomController::class);

Route::resource('bookings', BookingController::class);

Route::get('/calendars', [CalendarController::class, 'index'])
    ->name('calendars.index');