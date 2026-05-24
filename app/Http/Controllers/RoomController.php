<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $rooms = Room::paginate(10); 
    return view('rooms.index', compact('rooms'));
}

    
    public function create()
    {
        return view('rooms.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
    'room_number' => 'required',
    'type' => 'required',
    'price_per_night' => 'required|numeric',
    'capacity' => 'required|integer',
    'floor' => 'required|integer',
    'status' => 'required',
]);

        Room::create($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

  
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

   
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

  
    public function update(Request $request, Room $room)
    {
        $request->validate([
    'room_number' => 'required',
    'type' => 'required',
    'price_per_night' => 'required|numeric',
    'capacity' => 'required|integer',
    'floor' => 'required|integer',
    'status' => 'required',
]);

        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

  
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}