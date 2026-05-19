@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Booking List</h2>

    <a href="{{ route('bookings.create') }}" 
       class="bg-green-500 text-white px-4 py-2 rounded">
        + Add Booking
    </a>
</div>

<table class="w-full border border-gray-300 text-center">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">#</th>
            <th class="p-2">Customer</th>
            <th class="p-2">Room</th>
            <th class="p-2">Check In</th>
            <th class="p-2">Check Out</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($bookings as $key => $booking)
        <tr class="border-t">
            <td class="p-2">{{ $key + 1 }}</td>
            <td class="p-2">{{ $booking->customer_name }}</td>
            <td class="p-2">{{ $booking->room_number }}</td>
            <td class="p-2">{{ $booking->check_in }}</td>
            <td class="p-2">{{ $booking->check_out }}</td>

            <td class="p-2 space-x-2">
                <a href="{{ route('bookings.edit', $booking->id) }}" 
                   class="bg-yellow-400 px-3 py-1 rounded text-white">
                    Edit
                </a>

                <a href="{{ route('bookings.destroy', $booking->id) }}" 
                   class="bg-red-500 px-3 py-1 rounded text-white">
                    Delete
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-4">No bookings found</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection