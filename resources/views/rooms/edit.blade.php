<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f4f8; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .form-label { font-weight: 600; color: #444; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cdd5e0; padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: #1a73e8; box-shadow: 0 0 0 0.2rem rgba(26,115,232,0.2); }
        .btn-update { background-color: #f59e0b; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
        .btn-update:hover { background-color: #d97706; color: #fff; }
        .btn-cancel { border-radius: 8px; padding: 10px 30px; font-weight: 600; }
        .page-title { font-weight: 800; font-size: 1.5rem; }
        .section-divider { color: #1a73e8; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #e8f0fe; padding-bottom: 6px; margin-bottom: 18px; margin-top: 10px; }
        .room-badge { background: #e8f0fe; color: #1a73e8; font-size: 0.8rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card p-4" style="max-width: 800px; margin: auto;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="page-title mb-1"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Room</h2>
                <span class="room-badge">Room #{{ $room->room_number }}</span>
            </div>
            <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary btn-cancel">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="section-divider">Room Information</div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Room Number <span class="text-danger">*</span></label>
                    <input type="text" name="room_number"
                           class="form-control @error('room_number') is-invalid @enderror"
                           value="{{ old('room_number', $room->room_number) }}" placeholder="e.g. 101">
                    @error('room_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Room Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="">-- Select Type --</option>
                        @foreach(['Standard','Deluxe','Suite','VIP Room','Family Room'] as $type)
                            <option value="{{ $type }}" {{ old('type', $room->type) == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Price / Night ($) <span class="text-danger">*</span></label>
                    <input type="number" name="price_per_night" step="0.01" min="0"
                           class="form-control @error('price_per_night') is-invalid @enderror"
                           value="{{ old('price_per_night', $room->price_per_night) }}">
                    @error('price_per_night')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="capacity" min="1"
                           class="form-control @error('capacity') is-invalid @enderror"
                           value="{{ old('capacity', $room->capacity) }}">
                    @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Floor <span class="text-danger">*</span></label>
                    <input type="number" name="floor" min="1"
                           class="form-control @error('floor') is-invalid @enderror"
                           value="{{ old('floor', $room->floor) }}">
                    @error('floor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        @foreach(['Available','Booked','Maintenance'] as $status)
                            <option value="{{ $status }}" {{ old('status', $room->status) == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Optional room description...">{{ old('description', $room->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-update">
                    <i class="bi bi-arrow-clockwise me-1"></i> Update Room
                </button>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>