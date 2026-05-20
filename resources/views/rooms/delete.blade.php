@extends('layout')

@section('title', 'Delete Room')

@section('breadcrumb')
    <a href="#">Dashboard</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('rooms.index') }}">Rooms</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <span>Delete Room</span>
@endsection

@section('content')

<div style="max-width:600px; margin:auto;">

    <div class="card" style="text-align:center; padding:40px;">

        <div style="margin-bottom:20px;">

            <i class="fa-solid fa-trash"
            style="font-size:70px; color:#ef4444;"></i>

        </div>

        <h1 class="section-title" style="margin-bottom:10px;">
            Delete Room
        </h1>

        <p style="color:#94a3b8; margin-bottom:30px;">

            Are you sure you want to delete this room?

        </p>

        <div style="background:#f8fafc;
        border-radius:12px;
        padding:20px;
        margin-bottom:30px;">

            <img src="{{ $room->photo }}"
            width="180"
            height="120"
            style="border-radius:12px;
            object-fit:cover;
            margin-bottom:15px;">

            <h3 style="margin-bottom:6px;">
                {{ $room->name }}
            </h3>

            <p style="color:#64748b;">
                {{ $room->type }}
            </p>

        </div>

        <div style="display:flex;
        justify-content:center;
        gap:10px;">

            <form action="{{ route('rooms.destroy', $room) }}"
            method="POST">

                @csrf
                @method('DELETE')

                <button type="submit"
                class="btn-danger">

                    <i class="fa-solid fa-trash"></i>

                    Delete

                </button>

            </form>

            <a href="{{ route('rooms.index') }}"
            class="btn-secondary">

                Cancel

            </a>

        </div>

    </div>

</div>

@endsection