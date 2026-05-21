@extends('layouts.app')
@section('title', 'Add New Customer')

@push('styles')
<style>
    .form-label { font-weight: 600; color: #444; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid #cdd5e0; padding: 10px 14px; }
    .form-control:focus, .form-select:focus { border-color: #1a73e8; box-shadow: 0 0 0 0.2rem rgba(26,115,232,0.2); }
    .btn-save { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
    .btn-save:hover { background-color: #155cb5; color: #fff; }
    .btn-cancel { border-radius: 8px; padding: 10px 30px; font-weight: 600; }
    .page-title { font-weight: 800; font-size: 1.5rem; }
    .section-divider { color: #1a73e8; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #e8f0fe; padding-bottom: 6px; margin-bottom: 18px; margin-top: 10px; }
    .photo-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #e8f0fe; display: none; }
    .photo-placeholder { width: 100px; height: 100px; border-radius: 50%; background: #e8f0fe; color: #1a73e8; display: flex; align-items: center; justify-content: center; font-size: 2rem; }
</style>
@endpush

@section('content')
<div class="content-card" style="max-width: 800px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0"><i class="bi bi-person-plus me-2 text-primary"></i>Add New Customer</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-cancel">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="section-divider">Customer Information</div>

        {{-- Photo Upload --}}
        <div class="d-flex align-items-center gap-4 mb-4">
            <div>
                <div class="photo-placeholder" id="photoPlaceholder"><i class="bi bi-person"></i></div>
                <img id="photoPreview" class="photo-preview" src="#" alt="Preview">
            </div>
            <div>
                <label class="form-label">Profile Photo</label>
                <input type="file" name="photo" class="form-control" id="photoInput"
                       accept="image/*" style="width: 260px;">
                <small class="text-muted">JPG, PNG up to 2MB</small>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" >
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" >
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone') }}" >
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Room</label>
                <select name="room" class="form-select">
                    <option value="">-- Select Room --</option>
                    @foreach(['Standard','Deluxe','Suite','VIP Room','Family Room'] as $r)
                        <option value="{{ $r }}" {{ old('room') == $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="Active"  {{ old('status','Active') == 'Active'   ? 'selected' : '' }}>Active</option>
                    <option value="Inactive"{{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-save"><i class="bi bi-save me-1"></i> Save Customer</button>
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
            reader.onload = e => {
                document.getElementById('photoPreview').src = e.target.result;
                document.getElementById('photoPreview').style.display = 'block';
                document.getElementById('photoPlaceholder').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush