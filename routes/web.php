<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');




Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customers.index');

Route::get('/customers/create', [CustomerController::class, 'create'])
    ->name('customers.create');

Route::get('/customers/edit/{id}', [CustomerController::class, 'edit'])
    ->name('customers.edit');

Route::get('/customers/delete/{id}', [CustomerController::class, 'destroy'])
    ->name('customers.delete');




Route::get('/bookings', [BookingController::class, 'index'])
    ->name('bookings.index');

Route::get('/bookings/create', [BookingController::class, 'create'])
    ->name('bookings.create');

Route::post('/bookings/store', [BookingController::class, 'store'])
    ->name('bookings.store');

Route::get('/bookings/edit/{id}', [BookingController::class, 'edit'])
    ->name('bookings.edit');

Route::get('/bookings/delete/{id}', [BookingController::class, 'destroy'])
    ->name('bookings.delete');




Route::resource('rooms', RoomController::class);




Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar.index');