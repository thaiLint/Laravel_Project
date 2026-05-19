@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Delete Booking</h2>

<p>Are you sure you want to delete this booking?</p>

<form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button class="bg-red-500 px-3 py-1 rounded text-white">
        Delete
    </button>
</form>
</form>
@endsection