@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Create Booking</h2>

<form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
    @csrf

    <input type="text" name="customer_name" placeholder="Customer Name" class="w-full border p-2 rounded">

    <input type="text" name="room_number" placeholder="Room Number" class="w-full border p-2 rounded">

    <input type="date" name="check_in" class="w-full border p-2 rounded">

    <input type="date" name="check_out" class="w-full border p-2 rounded">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection