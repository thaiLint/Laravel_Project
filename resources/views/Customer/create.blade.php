@extends('layout')

@section('title', 'Add Customer')

@section('breadcrumb')
    <a href="#">Dashboard</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <a href="{{ route('customers.index') }}">Customers</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <span>Add Customer</span>
@endsection

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 class="section-title">Add Customer</h1>
        <p style="color:#94a3b8; font-size:14px; margin-top:4px;">Fill in the details to register a new customer</p>
    </div>
    <a href="{{ route('customers.index') }}" class="btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Back to List
    </a>
</div>

<div style="max-width:760px;">
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Personal Info --}}
        <div class="card" style="margin-bottom:20px;">
            <h2 style="font-size:15px; font-weight:600; color:#0f172a; margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid #f1f5f9;">
                <i class="fa-solid fa-user" style="color:#3b82f6; margin-right:8px;"></i>Personal Information
            </h2>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                <div>
                    <label class="form-label">Full Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                        placeholder="e.g. John Doe">
                    @error('name') <p class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Email Address <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="e.g. john@email.com">
                    @error('email') <p class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="form-input" placeholder="e.g. +855 12 345 678">
                    @error('phone') <p class="error-msg">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                        class="form-input">
                    @error('date_of_birth') <p class="error-msg">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-input">
                        <option value="">— Select gender —</option>
                        <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                        <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Status <span style="color:#ef4444;">*</span></label>
                    <select name="status" class="form-input {{ $errors->has('status') ? 'error' : '' }}">
                        <option value="active" {{ old('status','active')=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                    @error('status') <p class="error-msg">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Address --}}
        <div class="card" style="margin-bottom:20px;">
            <h2 style="font-size:15px; font-weight:600; color:#0f172a; margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid #f1f5f9;">
                <i class="fa-solid fa-location-dot" style="color:#3b82f6; margin-right:8px;"></i>Address
            </h2>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                <div style="grid-column:1/-1;">
                    <label class="form-label">Street Address</label>
                    <input type="text" name="address" value="{{ old('address') }}"
                        class="form-input" placeholder="e.g. 123 Main Street">
                </div>
                <div>
                    <label class="form-label">City</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="form-input" placeholder="e.g. Phnom Penh">
                </div>
                <div>
                    <label class="form-label">Country</label>
                    <input type="text" name="country" value="{{ old('country') }}"
                        class="form-input" placeholder="e.g. Cambodia">
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="card" style="margin-bottom:20px;">
            <h2 style="font-size:15px; font-weight:600; color:#0f172a; margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid #f1f5f9;">
                <i class="fa-solid fa-note-sticky" style="color:#3b82f6; margin-right:8px;"></i>Additional Notes
            </h2>
            <div>
                <label class="form-label">Notes</label>
                <textarea name="notes" rows="4" class="form-input"
                    placeholder="Any special notes or preferences...">{{ old('notes') }}</textarea>
            </div>
        </div>

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Save Customer
            </button>
            <a href="{{ route('customers.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection