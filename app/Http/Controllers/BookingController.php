<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;

class BookingController extends Controller
{
   public function index()
{
    $bookings       = Booking::with(['customer', 'room'])->paginate(10); // ✅ paginate()
    $totalBookings  = Booking::count();
    $checkedIn      = Booking::where('status', 'Checked In')->count();
    $pending        = Booking::where('status', 'Pending')->count();
    $cancelled      = Booking::where('status', 'Cancelled')->count();

    return view('bookings.index', compact(
        'bookings', 'totalBookings', 'checkedIn', 'pending', 'cancelled'
    ));
}

    public function create()
    {
        return view('bookings.create');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('bookings.index');
    }
}