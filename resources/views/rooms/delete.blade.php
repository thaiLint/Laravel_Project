{{--
  NOTE: In a typical Laravel resource setup, delete is handled directly
  from index.blade.php via a form with @method('DELETE').
  This file provides a dedicated confirmation page if you prefer a separate step.
  Route: GET /rooms/{id}/delete  →  rooms.delete (optional)
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f4f8; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .icon-danger { font-size: 3.5rem; color: #dc3545; }
        .detail-row { background: #f8f9fa; border-radius: 8px; padding: 10px 16px; margin-bottom: 8px; }
        .detail-label { font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .detail-value { font-weight: 500; color: #222; }
        .btn-confirm-delete { background-color: #dc3545; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
        .btn-confirm-delete:hover { background-color: #b02a37; color: #fff; }
        .btn-cancel { border-radius: 8px; padding: 10px 30px; font-weight: 600; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card p-5 text-center" style="max-width: 540px; margin: auto;">

        <div class="mb-3">
            <i class="bi bi-exclamation-triangle-fill icon-danger"></i>
        </div>

        <h4 class="fw-bold mb-1">Delete Room?</h4>
        <p class="text-muted mb-4">This action cannot be undone. The room below will be permanently removed.</p>

        {{-- Room Details Summary --}}
        <div class="text-start mb-4">
            <div class="detail-row d-flex justify-content-between">
                <span class="detail-label">Room Number</span>
                <span class="detail-value">{{ $room->room_number }}</span>
            </div>
            <div class="detail-row d-flex justify-content-between">
                <span class="detail-label">Type</span>
                <span class="detail-value">{{ $room->type }}</span>
            </div>
            <div class="detail-row d-flex justify-content-between">
                <span class="detail-label">Floor</span>
                <span class="detail-value">Floor {{ $room->floor }}</span>
            </div>
            <div class="detail-row d-flex justify-content-between">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    @if($room->status === 'Available')
                        <span class="badge bg-success">Available</span>
                    @elseif($room->status === 'Booked')
                        <span class="badge bg-danger">Booked</span>
                    @else
                        <span class="badge bg-warning text-dark">Maintenance</span>
                    @endif
                </span>
            </div>
        </div>

        {{-- Confirm Delete Form --}}
        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary btn-cancel">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-confirm-delete">
                    <i class="bi bi-trash-fill me-1"></i> Yes, Delete
                </button>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>