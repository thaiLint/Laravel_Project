<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $currentMonth = $request->filled('month')
            ? Carbon::parse($request->month)->startOfMonth()
            : Carbon::now()->startOfMonth();

        // Get bookings
        $rawBookings = Booking::with(['customer', 'room'])
            ->whereYear('check_in', $currentMonth->year)
            ->whereMonth('check_in', $currentMonth->month)
            ->orderBy('check_in')
            ->get();

        // Format bookings per day
        $bookings = [];

        foreach ($rawBookings as $b) {
            $day = Carbon::parse($b->check_in)->day;

            $bookings[$day][] = [
                'id'     => $b->id,
                'name'   => $b->customer->name ?? 'Guest',
                'room'   => $b->room->room_number ?? '',
                'time'   => $b->check_in_time
                    ? Carbon::parse($b->check_in_time)->format('h:i A')
                    : '',
                'status' => $b->status,
            ];
        }

        
        $editBooking = null;

        if ($request->filled('edit')) {
            $editBooking = Booking::with(['customer', 'room'])
                ->find($request->edit);
        }

        return view('calendars.index', compact(
            'bookings',
            'currentMonth',
            'editBooking'
        ));
    }
}