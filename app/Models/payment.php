<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'customer_id', 'amount',
        'method', 'status', 'transaction_id',
        'payment_date', 'notes',
    ];
public function pay(Request $request, Booking $booking)
{
    $booking->update(['payment_status' => $request->payment_status]);

    return redirect()->route('payments.index')
                     ->with('success', 'Payment saved successfully!');
}

}