@extends('layout')

@section('title', 'Create Room')

@section('breadcrumb')
    <a href="#">Dashboard</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('rooms.index') }}">Rooms</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <span>Create Room</span>
@endsection

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">

    <div>
        <h1 class="section-title">Create Room</h1>

        <p style="color:#94a3b8; font-size:14px; margin-top:4px;">
            Add a new hotel room
        </p>
    </div>

    <a href="{{ route('rooms.index') }}" class="btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>

</div>

<div style="max-width:760px;">

    <form action="{{ route('rooms.store') }}"
    method="POST">

        @csrf

        <div class="card" style="margin-bottom:20px;">

            <h2 style="font-size:15px; font-weight:600; color:#0f172a; margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid #f1f5f9;">

                <i class="fa-solid fa-door-open"
                style="color:#3b82f6; margin-right:8px;"></i>

                Room Information

            </h2>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">

                <div>

                    <label class="form-label">
                        Room Name
                    </label>

                    <input type="text"
                    name="name"
                    class="form-input"
                    placeholder="Enter room name">

                </div>

                <div>

                    <label class="form-label">
                        Room Type
                    </label>

                    <select name="type"
                    class="form-input">

                        <option>Single Room</option>
                        <option>Double Room</option>
                        <option>VIP Room</option>

                    </select>

                </div>

                <div>

                    <label class="form-label">
                        Price
                    </label>

                    <input type="number"
                    name="price"
                    class="form-input"
                    placeholder="Enter room price">

                </div>

                <div>

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                    class="form-input">

                        <option>Available</option>
                        <option>Booked</option>

                    </select>

                </div>

                <div style="grid-column:1/-1;">

                    <label class="form-label">
                        Photo URL
                    </label>

                    <input type="text"
                    name="photo"
                    class="form-input"
                    placeholder="Paste image URL">

                </div>

            </div>

        </div>

        <div style="display:flex; gap:10px;">

            <button type="submit" class="btn-primary">

                <i class="fa-solid fa-floppy-disk"></i>

                Save Room

            </button>

            <a href="{{ route('rooms.index') }}"
            class="btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection