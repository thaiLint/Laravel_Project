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

<<<<<<< HEAD



Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar.index');
=======
<<<<<<< HEAD
Route::get('/', function () {
    return view('home');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/admin/room', function () {
    return view('admin.room');
});


Route::get('/admin/calendar', function () {
    return view('admin.calendar');
});

Route::get('/admin/customer', function () {
    return view('admin.customer');
});


Route::get('/admin/payment', function () {
    return view('admin.payment');
});


Route::get('/admin/report', function () {
    return view('admin.report');
});
=======
Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
>>>>>>> 257f029041865ecc286816787e838c779ce2fdee
>>>>>>> 438c3a3637213cd7d39c28e09aaf0ebcc75ea381
