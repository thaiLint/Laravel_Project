
@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold">Room Management</h3>
            <p class="text-muted">Manage hotel rooms</p>
        </div>

        <a href="{{ route('rooms.create') }}"
        class="btn btn-primary">
            + Add Room
        </a>

    </div>

    <div class="card shadow border-0">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-primary">

                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Room Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($rooms as $room)

                    <tr>

                        <td>{{ $room->id }}</td>

                        <td>
                            <img src="{{ $room->photo }}"
                            width="60"
                            height="60"
                            class="rounded object-fit-cover">
                        </td>

                        <td>{{ $room->name }}</td>

                        <td>{{ $room->type }}</td>

                        <td>${{ $room->price }}</td>

                        <td>

                            <span class="badge bg-success">
                                {{ $room->status }}
                            </span>

                        </td>

                        <td class="text-center">

                            <a href="{{ route('rooms.edit', $room->id) }}"
                            class="btn btn-warning btn-sm text-white">
                                Edit
                            </a>
                            <a href="{{ route('rooms.show', $room->id) }}"
                                class="btn btn-danger btn-sm">
                                 Delete
                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection