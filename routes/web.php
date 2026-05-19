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


Route::get('/calendars', [CalendarController::class, 'index'])
    ->name('calendars.index');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');

Route::get('/bookings/edit/{id}', [BookingController::class, 'edit'])->name('bookings.edit');

Route::get('/bookings/delete/{id}', [BookingController::class, 'destroy'])->name('bookings.delete');