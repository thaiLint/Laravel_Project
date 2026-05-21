@extends('layouts.app')
@section('title', 'Room Management')

@push('styles')
<style>
    .table thead { background-color: #1a73e8; color: white; }
    .table thead th { font-weight: 500; border: none; padding: 14px 16px; }
    .table tbody tr { background: #fff; }
    .table tbody td { vertical-align: middle; padding: 14px 16px; }
    .badge-available   { background-color: #28a745; }
    .badge-booked      { background-color: #dc3545; }
    .badge-maintenance { background-color: #ffc107; color: #000; }
    .btn-add { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 500; }
    .btn-add:hover { background-color: #155cb5; color: #fff; }
    .search-input { border-radius: 8px; border: 1px solid #cdd5e0; width: 280px; }
    .page-title { font-weight: 800; font-size: 1.8rem; }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Room Management</h2>
            <div class="d-flex gap-3 align-items-center">
                <input type="text" class="form-control search-input" id="searchInput" placeholder="Search room...">
                <a href="{{ route('rooms.create') }}" class="btn btn-add px-4">
                    <i class="bi bi-plus-lg me-1"></i> Add Room
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless rounded overflow-hidden" id="roomTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Number</th>
                        <th>Type</th>
                        <th>Price / Night</th>
                        <th>Capacity</th>
                        <th>Floor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td><strong>{{ $room->room_number }}</strong></td>
                        <td>{{ $room->type }}</td>
                        <td>${{ number_format($room->price_per_night, 2) }}</td>
                        <td>{{ $room->capacity }} person(s)</td>
                        <td>Floor {{ $room->floor }}</td>
                        <td>
                            @if($room->status === 'Available')
                                <span class="badge badge-available rounded-pill px-3 py-2">Available</span>
                            @elseif($room->status === 'Booked')
                                <span class="badge badge-booked rounded-pill px-3 py-2">Booked</span>
                            @else
                                <span class="badge badge-maintenance rounded-pill px-3 py-2">Maintenance</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm px-3">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Delete this room?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No rooms found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $rooms->links() }}
        </div>

    </div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const val = this.value.toLowerCase();
        document.querySelectorAll('#roomTable tbody tr').forEach(r => {
            r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush