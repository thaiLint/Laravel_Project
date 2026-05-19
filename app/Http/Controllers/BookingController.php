<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('Booking.index');
    }

    public function create()
    {
        return view('Booking.create');
    }

    public function edit($id)
    {
        return view('Booking.update');
    }

    public function destroy($id)
    {
        return view('Booking.delete');
    }
}