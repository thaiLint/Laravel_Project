@extends('layouts.app')
@section('title', 'Edit Booking')

@section('content')
<div class="content-card" style="max-width:860px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Booking</h2>
            <span style="background:#e8f0fe; color:#1a73e8; font-size:0.8rem; font-weight:600; padding:4px 12px; border-radius:20px;">Booking #{{ $booking->id }}</span>
        </div>
        <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-cancel">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="section-divider">Customer & Room</div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Customer <span class="text-danger">*</span></label>
                <select name="customer_id" id="customerSelect" class="form-select @error('customer_id') is-invalid @enderror">
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" data-phone="{{ $c->phone }}" data-email="{{ $c->email }}"
                            {{ old('customer_id', $booking->customer_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Room <span class="text-danger">*</span></label>
                <select name="room_id" id="roomSelect" class="form-select @error('room_id') is-invalid @enderror">
                    <option value="">-- Select Room --</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" data-price="{{ $r->price_per_night }}"
                            {{ old('room_id', $booking->room_id) == $r->id ? 'selected' : '' }}>
                            Room {{ $r->room_number }} — {{ $r->type }} (${{ $r->price_per_night }}/night)
                        </option>
                    @endforeach
                </select>
                @error('room_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control bg-light" id="previewPhone" value="{{ $booking->customer->phone ?? '' }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" class="form-control bg-light" id="previewEmail" value="{{ $booking->customer->email ?? '' }}" readonly>
            </div>
        </div>

        <div class="section-divider">Stay Details</div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">Check-In Date <span class="text-danger">*</span></label>
                <input type="date" name="check_in" id="checkIn"
                       class="form-control @error('check_in') is-invalid @enderror"
                       value="{{ old('check_in', \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d')) }}">
                @error('check_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Check-Out Date <span class="text-danger">*</span></label>
                <input type="date" name="check_out" id="checkOut"
                       class="form-control @error('check_out') is-invalid @enderror"
                       value="{{ old('check_out', \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d')) }}">
                @error('check_out')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Number of Guests <span class="text-danger">*</span></label>
                <input type="number" name="guests" min="1"
                       class="form-control @error('guests') is-invalid @enderror"
                       value="{{ old('guests', $booking->guests) }}">
                @error('guests')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div id="pricePreview" style="background:#e8f0fe; border-radius:10px; padding:16px 20px; border-left:4px solid #1a73e8; margin-bottom:20px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small mb-1">Estimated Total</div>
                    <div id="totalDisplay" style="font-size:1.4rem; font-weight:800; color:#1a73e8;">${{ number_format($booking->total_price, 2) }}</div>
                    <div class="text-muted small" id="nightsDisplay"></div>
                </div>
                <i class="bi bi-calculator fs-2 text-primary opacity-50"></i>
            </div>
        </div>
        <input type="hidden" name="total_price" id="totalPrice" value="{{ $booking->total_price }}">

        <div class="section-divider">Status & Payment</div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Booking Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    @foreach(['Pending','Confirmed','Checked In','Checked Out','Cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('status', $booking->status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror">
                    @foreach(['Unpaid','Partial','Paid'] as $p)
                        <option value="{{ $p }}" {{ old('payment_status', $booking->payment_status) == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                @error('payment_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Special Requests / Notes</label>
            <textarea name="notes" rows="3" class="form-control">{{ old('notes', $booking->notes) }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-update"><i class="bi bi-arrow-clockwise me-1"></i> Update Booking</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const roomSel = document.getElementById('roomSelect');
    const ci = document.getElementById('checkIn');
    const co = document.getElementById('checkOut');
    function calcTotal() {
        const opt = roomSel.options[roomSel.selectedIndex];
        const price = parseFloat(opt?.dataset?.price || 0);
        const d1 = new Date(ci.value), d2 = new Date(co.value);
        if (!price || isNaN(d1) || isNaN(d2) || d2 <= d1) return;
        const nights = Math.ceil((d2 - d1) / 86400000);
        const total = nights * price;
        document.getElementById('totalDisplay').textContent = '$' + total.toFixed(2);
        document.getElementById('nightsDisplay').textContent = nights + ' night(s) × $' + price.toFixed(2);
        document.getElementById('totalPrice').value = total.toFixed(2);
    }
    [roomSel, ci, co].forEach(el => el.addEventListener('change', calcTotal));
    ci.addEventListener('change', () => { co.min = ci.value; calcTotal(); });
    calcTotal();
    document.getElementById('customerSelect').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        document.getElementById('previewPhone').value = opt.dataset.phone || '';
        document.getElementById('previewEmail').value = opt.dataset.email || '';
    });
</script>
@endpush