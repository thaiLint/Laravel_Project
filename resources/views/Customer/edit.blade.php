@extends('layouts.app')
@section('title', 'Edit Customer')

@push('styles')
<style>
    .form-label { font-weight: 600; color: #444; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid #cdd5e0; padding: 10px 14px; }
    .form-control:focus, .form-select:focus { border-color: #1a73e8; box-shadow: 0 0 0 0.2rem rgba(26,115,232,0.2); }
    .btn-update { background-color: #f59e0b; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
    .btn-update:hover { background-color: #d97706; color: #fff; }
    .btn-cancel { border-radius: 8px; padding: 10px 30px; font-weight: 600; }
    .page-title { font-weight: 800; font-size: 1.5rem; }
    .section-divider { color: #1a73e8; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #e8f0fe; padding-bottom: 6px; margin-bottom: 18px; margin-top: 10px; }
    .customer-badge { background: #e8f0fe; color: #1a73e8; font-size: 0.8rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
    .photo-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #e8f0fe; }
</style>
@endpush

@section('content')
<div class="content-card" style="max-width: 800px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Customer</h2>
            <span class="customer-badge">{{ $customer->name }}</span>
        </div>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-cancel">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="section-divider">Customer Information</div>

        {{-- Photo --}}
        <div class="d-flex align-items-center gap-4 mb-4">
            <div>
                @if($customer->photo)
                    <img id="photoPreview" class="photo-preview"
                         src="{{ asset('storage/' . $customer->photo) }}" alt="Photo">
                @else
                    <img id="photoPreview" class="photo-preview"
                         src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=e8f0fe&color=1a73e8&size=100"
                         alt="Photo">
                @endif
            </div>
            <div>
                <label class="form-label">Change Photo</label>
                <input type="file" name="photo" class="form-control" id="photoInput"
                       accept="image/*" style="width: 260px;">
                <small class="text-muted">Leave blank to keep current photo</small>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $customer->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $customer->email) }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $customer->phone) }}">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Room</label>
                <select name="room" class="form-select">
                    <option value="">-- Select Room --</option>
                    @foreach(['Standard','Deluxe','Suite','VIP Room','Family Room'] as $r)
                        <option value="{{ $r }}" {{ old('room', $customer->room) == $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="Active"   {{ old('status', $customer->status) == 'Active'   ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $customer->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-update"><i class="bi bi-arrow-clockwise me-1"></i> Update Customer</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('photoInput').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById('photoPreview').src = e.target.result; };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush