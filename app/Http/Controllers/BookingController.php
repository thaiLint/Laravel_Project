<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'room'])->paginate(10);

        $totalBookings = Booking::count();
        $checkedIn = Booking::where('status', 'checked_in')->count();
        $pending = Booking::where('status', 'pending')->count();
        $cancelled = Booking::where('status', 'cancelled')->count();

        return view('bookings.index', compact(
            'bookings',
            'totalBookings',
            'checkedIn',
            'pending',
            'cancelled'
        ));
    }

    public function create()
    {
        $customers = Customer::all();

        // only available rooms
        $rooms = Room::where('availability', 'available')->get();

        return view('bookings.create', compact('customers', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'    => 'required|exists:customers,id',
            'room_id'        => 'required|exists:rooms,id',
            'check_in'       => 'required|date',
            'check_out'      => 'required|date|after:check_in',
            'guests'         => 'required|integer|min:1',
            'status'         => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'payment_status' => 'nullable|in:unpaid,partial,paid',
            'notes'          => 'nullable|string',
        ]);

        
        $room = Room::findOrFail($validated['room_id']);

        $checkIn = new \DateTime($validated['check_in']);
        $checkOut = new \DateTime($validated['check_out']);
        $nights = $checkIn->diff($checkOut)->days;

        
        $totalPrice = $room->price_per_night * $nights;

        
        $booking = Booking::create([
            'customer_id'    => $validated['customer_id'],
            'room_id'        => $validated['room_id'],
            'check_in'       => $validated['check_in'],
            'check_out'      => $validated['check_out'],
            'guests'         => $validated['guests'],
            'status'         => $validated['status'],
            'payment_status' => $validated['payment_status'] ?? 'unpaid',
            'notes'          => $validated['notes'],
            'total_price'    => $totalPrice,
        ]);

        
        Room::where('id', $validated['room_id'])
            ->update(['availability' => 'unavailable']);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $customers = Customer::all();
        $rooms = Room::all();

        return view('bookings.edit', compact('booking', 'customers', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id'    => 'required|exists:customers,id',
            'room_id'        => 'required|exists:rooms,id',
            'check_in'       => 'required|date',
            'check_out'      => 'required|date|after:check_in',
            'guests'         => 'required|integer|min:1',
            'status'         => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'payment_status' => 'nullable|in:unpaid,partial,paid',
            'notes'          => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);
        $oldRoomId = $booking->room_id;

        
        $room = Room::findOrFail($validated['room_id']);
        $checkIn = new \DateTime($validated['check_in']);
        $checkOut = new \DateTime($validated['check_out']);
        $nights = $checkIn->diff($checkOut)->days;

        $totalPrice = $room->price_per_night * $nights;

    
        $booking->update([
            'customer_id'    => $validated['customer_id'],
            'room_id'        => $validated['room_id'],
            'check_in'       => $validated['check_in'],
            'check_out'      => $validated['check_out'],
            'guests'         => $validated['guests'],
            'status'         => $validated['status'],
            'payment_status' => $validated['payment_status'] ?? 'unpaid',
            'notes'          => $validated['notes'],
            'total_price'    => $totalPrice,
        ]);

        // Free old room if changed or cancelled
        if ($oldRoomId != $validated['room_id']) {
            Room::where('id', $oldRoomId)
                ->update(['availability' => 'available']);

            Room::where('id', $validated['room_id'])
                ->update(['availability' => 'unavailable']);
        }

        if (in_array($validated['status'], ['cancelled', 'checked_out'])) {
            Room::where('id', $oldRoomId)
                ->update(['availability' => 'available']);
        }

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

    
        Room::where('id', $booking->room_id)
            ->update(['availability' => 'available']);

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}