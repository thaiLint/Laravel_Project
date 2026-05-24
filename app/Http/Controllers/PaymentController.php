<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $bookings      = Booking::with(['customer', 'room'])->paginate(10);
        $totalBookings = Booking::count();
        $totalPaid     = Booking::where('payment_status', 'Paid')->sum('total_price');
        $totalUnpaid   = Booking::where('payment_status', 'Unpaid')->sum('total_price');
        $totalPartial  = Booking::where('payment_status', 'Partial')->sum('total_price');

        return view('payments.index', compact(
            'bookings', 'totalBookings', 'totalPaid', 'totalUnpaid', 'totalPartial'
        ));
    }

    // Process payment from modal
    public function pay(Request $request, Booking $booking)
    {
        $request->validate([
            'amount'         => 'required|numeric|min:0',
            'method'         => 'required|in:Cash,Credit Card,Bank Transfer,Online',
            'payment_status' => 'required|in:Paid,Partial',
            'transaction_id' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        // Save to payments table
        Payment::create([
            'booking_id'     => $booking->id,
            'customer_id'    => $booking->customer_id,
            'amount'         => $request->amount,
            'method'         => $request->method,
            'status'         => $request->payment_status,
            'transaction_id' => $request->transaction_id,
            'payment_date'   => now(),
            'notes'          => $request->notes,
        ]);

        // Update booking payment status
        $booking->update(['payment_status' => $request->payment_status]);

        return redirect()->route('payments.index')
                         ->with('success', 'Payment saved successfully!');
    }
}