<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Rooms</h1>
    <a href="/rooms/create" class="bg-green-500 text-white px-4 py-2 rounded-xl">
        + Add Room
    </a>
</div>

<!-- Cards like your UI -->
<div class="grid grid-cols-4 gap-6">

@foreach($rooms as $room)
<div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

    <!-- Image -->
    <img src="{{ asset('storage/'.$room->image) }}" 
         class="w-full h-44 object-cover">

    
    <div class="p-4">
        <h2 class="text-lg font-bold">Room {{ $room->room_number }}</h2>
        <p class="text-gray-500 text-sm">{{ $room->type }}</p>

        
        <div class="flex justify-between items-center mt-3">
            <span class="text-green-500 font-semibold">
                ${{ $room->300 }}
            </span>

            <span class="text-xs px-2 py-1 bg-gray-100 rounded-lg">
                {{ $room->status }}
            </span>
        </div>

        <!-- Actions -->
        <div class="flex justify-between mt-4 text-sm">
            <a href="/rooms/{{ $room->id }}/edit" class="text-blue-500">
                Edit
            </a>

            <form action="/rooms/{{ $room->id }}" method="POST">
                @csrf @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
        </div>
    </div>

</div>
@endforeach

</div>

@endsection