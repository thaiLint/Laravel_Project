<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f4f8; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .form-label { font-weight: 600; color: #444; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cdd5e0; padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: #1a73e8; box-shadow: 0 0 0 0.2rem rgba(26,115,232,0.2); }
        .btn-save { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
        .btn-save:hover { background-color: #155cb5; color: #fff; }
        .btn-cancel { border-radius: 8px; padding: 10px 30px; font-weight: 600; }
        .page-title { font-weight: 800; font-size: 1.5rem; }
        .section-divider { color: #1a73e8; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #e8f0fe; padding-bottom: 6px; margin-bottom: 18px; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card p-4" style="max-width: 800px; margin: auto;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0"><i class="bi bi-door-open me-2 text-primary"></i>Add New Room</h2>
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
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            <div class="section-divider">Room Information</div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Room Number <span class="text-danger">*</span></label>
                    <input type="text" name="room_number" class="form-control @error('room_number') is-invalid @enderror"
                           value="{{ old('room_number') }}" placeholder="e.g. 101">
                    @error('room_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Room Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="">-- Select Type --</option>
                        <option value="Standard" {{ old('type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                        <option value="Deluxe" {{ old('type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                        <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                        <option value="VIP Room" {{ old('type') == 'VIP Room' ? 'selected' : '' }}>VIP Room</option>
                        <option value="Family Room" {{ old('type') == 'Family Room' ? 'selected' : '' }}>Family Room</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Price / Night ($) <span class="text-danger">*</span></label>
                    <input type="number" name="price_per_night" step="0.01" min="0"
                           class="form-control @error('price_per_night') is-invalid @enderror"
                           value="{{ old('price_per_night') }}" placeholder="e.g. 99.99">
                    @error('price_per_night')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="capacity" min="1"
                           class="form-control @error('capacity') is-invalid @enderror"
                           value="{{ old('capacity') }}" placeholder="e.g. 2">
                    @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Floor <span class="text-danger">*</span></label>
                    <input type="number" name="floor" min="1"
                           class="form-control @error('floor') is-invalid @enderror"
                           value="{{ old('floor') }}" placeholder="e.g. 3">
                    @error('floor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="">-- Select Status --</option>
                        <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Booked" {{ old('status') == 'Booked' ? 'selected' : '' }}>Booked</option>
                        <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                          placeholder="Optional room description...">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-save">
                    <i class="bi bi-save me-1"></i> Save Room
                </button>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>