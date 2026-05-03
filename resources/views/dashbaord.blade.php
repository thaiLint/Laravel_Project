// routes/web.p
use App\Http\Controllers\BookingController;
Route::resource('bookings', BookingController::class);

// app/Models/Booking.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'guest_name','room_type','check_in','check_out','status'
    ];
}
// database/migrations/create_bookings_table.php
public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('guest_name');
        $table->string('room_type');
        $table->date('check_in');
        $table->date('check_out');
        $table->string('status');
        $table->timestamps();
    });
}
// app/Http/Controllers/BookingController.php
namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        Booking::create($request->all());
        return redirect()->route('bookings.index');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        Booking::findOrFail($id)->update($request->all());

        return redirect()->route('bookings.index');
    }

    public function destroy($id)
    {
        Booking::destroy($id);
        return redirect()->route('bookings.index');
    }
}

// resources/views/layouts/ap
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

<!-- Sidebar -->
<div class="w-64 h-screen bg-white shadow p-5">
<h2 class="text-xl font-bold mb-6">Hotelify</h2>
<ul class="space-y-4 text-gray-600">
<li><a href="/bookings" class="text-green-500 font-semibold">Dashboard</a></li>
<li>Rooms</li>
<li>Customers</li>
<li>Reports</li>
</ul>
</div>

<!-- Content -->
<div class="flex-1 p-6">
('content')
</div>

</div>

</body>
</html>


// resources/views/bookings/index.blade.php
@extends('layouts.app')
@section('content')

<div class="flex justify-between mb-4">
<h1 class="text-2xl font-bold">Hotel Dashboard</h1>
<a href="/bookings/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Add</a>
</div>

<div class="grid grid-cols-4 gap-4 mb-6">
<div class="bg-white p-4 rounded shadow">
<p>Total Bookings</p>
<h2 class="text-xl font-bold">{{ $bookings->count() }}</h2>
</div>
</div>

<div class="bg-white p-4 rounded shadow">
<table class="w-full text-sm">
<thead>
<tr class="border-b">
<th>Name</th>
<th>Room</th>
<th>Check In</th>
<th>Check Out</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($bookings as $b)
<tr class="border-b">
<td>{{ $b->guest_name }}</td>
<td>{{ $b->room_type }}</td>
<td>{{ $b->check_in }}</td>
<td>{{ $b->check_out }}</td>
<td>{{ $b->status }}</td>
<td>
<a href="/bookings/{{ $b->id }}/edit" class="text-blue-500">Edit</a>
<form action="/bookings/{{ $b->id }}" method="POST" class="inline">
@csrf @method('DELETE')
<button class="text-red-500">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>

@endsection


// resources/views/bookings/create.blade.php
@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">Add Booking</h2>
<form method="POST" action="/bookings" class="space-y-3">
@csrf
<input name="guest_name" class="border p-2 w-full" placeholder="Guest Name">
<input name="room_type" class="border p-2 w-full" placeholder="Room Type">
<input type="date" name="check_in" class="border p-2 w-full">
<input type="date" name="check_out" class="border p-2 w-full">
<input name="status" class="border p-2 w-full" placeholder="Status">
<button class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection


// resources/views/bookings/edit.blade.php
@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">Edit Booking</h2>
<form method="POST" action="/bookings/{{ $booking->id }}" class="space-y-3">
@csrf @method('PUT')
<input name="guest_name" value="{{ $booking->guest_name }}" class="border p-2 w-full">
<input name="room_type" value="{{ $booking->room_type }}" class="border p-2 w-full">
<input type="date" name="check_in" value="{{ $booking->check_in }}" class="border p-2 w-full">
<input type="date" name="check_out" value="{{ $booking->check_out }}" class="border p-2 w-full">
<input name="status" value="{{ $booking->status }}" class="border p-2 w-full">
<button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection

