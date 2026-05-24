<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('customers', CustomerController::class);


Route::resource('rooms', RoomController::class);

Route::resource('bookings', BookingController::class);
Route::put('/bookings/{id}', [BookingController::class, 'update'])
    ->name('bookings.update');

Route::get('/calendars', [CalendarController::class, 'index'])
    ->name('calendars.index');
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::patch('/payments/{booking}/pay', [PaymentController::class, 'pay'])->name('payments.pay');