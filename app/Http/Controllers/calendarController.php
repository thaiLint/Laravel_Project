<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{

    public function index(Request $request)
    {
        $date = $request->month;

        $currentMonth = $date
            ? Carbon::parse($date)->startOfMonth()
            : Carbon::now()->startOfMonth();

        return view('calendars.index', compact('currentMonth'));
}
}
