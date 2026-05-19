@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Update Booking</h2>

<form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <input type="text" name="customer_name" value="{{ $booking->customer_name }}" class="w-full border p-2 rounded">

    <input type="text" name="room_number" value="{{ $booking->room_number }}" class="w-full border p-2 rounded">

    <input type="date" name="check_in" value="{{ $booking->check_in }}" class="w-full border p-2 rounded">

    <input type="date" name="check_out" value="{{ $booking->check_out }}" class="w-full border p-2 rounded">

    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection