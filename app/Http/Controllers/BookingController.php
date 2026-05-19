public function edit($id)
{
    $booking = Booking::findOrFail($id);
    return view('booking.update', compact('booking'));
}

public function destroy($id)
{
    $booking = Booking::findOrFail($id);
    return view('booking.delete', compact('booking'));
}