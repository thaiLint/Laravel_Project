@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Calendar View</h1>

        <div class="flex gap-2">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Month</button>
            <button class="px-4 py-2 bg-gray-200 rounded-lg">Week</button>
            <button class="px-4 py-2 bg-gray-200 rounded-lg">Day</button>
        </div>
    </div>

    <!-- Calendar Card -->
    <div class="bg-white p-6 rounded-2xl shadow">

        <!-- Top Controls -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 bg-gray-200 rounded">◀</button>
                <button class="px-3 py-1 bg-gray-200 rounded">▶</button>
                <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded">Today</button>
            </div>

            <h2 class="text-lg font-semibold">May 2025</h2>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-2 text-center">

            <!-- Days -->
            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                <div class="font-semibold text-gray-500">{{ $day }}</div>
            @endforeach

            <!-- Dates -->
            @for($i = 1; $i <= 31; $i++)
                <div class="h-24 border rounded-lg p-1 relative bg-gray-50">

                    <!-- Date -->
                    <span class="absolute top-1 left-2 text-sm text-gray-500">{{ $i }}</span>

                    <!-- Example Booking -->
                    @if($i == 6)
                        <div class="mt-5 text-xs bg-green-200 text-green-700 px-2 py-1 rounded">
                            09:00 AM
                        </div>
                    @endif

                    @if($i == 7)
                        <div class="mt-5 text-xs bg-blue-200 text-blue-700 px-2 py-1 rounded">
                            01:00 PM
                        </div>
                    @endif

                    @if($i == 14)
                        <div class="mt-5 text-xs bg-red-200 text-red-700 px-2 py-1 rounded">
                            04:00 PM
                        </div>
                    @endif

                </div>
            @endfor

        </div>
    </div>

    <!-- Booking Details -->
    <div class="bg-white mt-6 p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Booking</h2>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-sm mb-1">Customer</label>
                <input type="text" class="w-full border rounded-lg p-2" placeholder="John Doe">
            </div>

            <div>
                <label class="block text-sm mb-1">Service</label>
                <input type="text" class="w-full border rounded-lg p-2" placeholder="Room Reservation">
            </div>

            <div>
                <label class="block text-sm mb-1">Date</label>
                <input type="date" class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Time</label>
                <input type="time" class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm mb-1">Guests</label>
                <input type="text" class="w-full border rounded-lg p-2" placeholder="2 Adults">
            </div>

            <div>
                <label class="block text-sm mb-1">Status</label>
                <select class="w-full border rounded-lg p-2">
                    <option>Pending</option>
                    <option>Confirmed</option>
                    <option>Cancelled</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="block text-sm mb-1">Notes</label>
                <textarea class="w-full border rounded-lg p-2"></textarea>
            </div>

        </div>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-3 gap-4 mt-6">

        <div class="bg-yellow-100 p-4 rounded-xl text-center">
            <h3 class="font-semibold">Pending</h3>
            <p class="text-sm">Awaiting confirmation</p>
        </div>

        <div class="bg-green-100 p-4 rounded-xl text-center">
            <h3 class="font-semibold">Confirmed</h3>
            <p class="text-sm">Booking confirmed</p>
        </div>

        <div class="bg-red-100 p-4 rounded-xl text-center">
            <h3 class="font-semibold">Cancelled</h3>
            <p class="text-sm">Booking cancelled</p>
        </div>

    </div>

</div>
@endsection