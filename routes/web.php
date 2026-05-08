<?php

use Illuminate\Support\Facades\Route;

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