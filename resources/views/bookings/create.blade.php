@extends('layouts.app')
@section('title', 'Add New Booking')

@section('content')
<div class="content-card" style="max-width:860px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0"><i class="bi bi-calendar2-plus me-2 text-primary"></i>Add New Booking</h2>
        <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-cancel">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="section-divider">Customer & Room</div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Customer <span class="text-danger">*</span></label>
                <select name="customer_id" id="customerSelect" class="form-select @error('customer_id') is-invalid @enderror">
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" data-phone="{{ $c->phone }}" data-email="{{ $c->email }}"
                            {{ old('customer_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
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
                            {{ old('room_id') == $r->id ? 'selected' : '' }}>
                            Room {{ $r->room_number }} — {{ $r->type }} (${{ $r->price_per_night }}/night)
                        </option>
                    @endforeach
                </select>
                @error('room_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-3" id="customerInfo" style="display:none;">
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control bg-light" id="previewPhone" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" class="form-control bg-light" id="previewEmail" readonly>
            </div>
        </div>

        <div class="section-divider">Stay Details</div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">Check-In Date <span class="text-danger">*</span></label>
                <input type="date" name="check_in" id="checkIn"
                       class="form-control @error('check_in') is-invalid @enderror"
                       value="{{ old('check_in') }}" min="{{ date('Y-m-d') }}">
                @error('check_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Check-Out Date <span class="text-danger">*</span></label>
                <input type="date" name="check_out" id="checkOut"
                       class="form-control @error('check_out') is-invalid @enderror"
                       value="{{ old('check_out') }}">
                @error('check_out')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Number of Guests <span class="text-danger">*</span></label>
                <input type="number" name="guests" min="1"
                       class="form-control @error('guests') is-invalid @enderror"
                       value="{{ old('guests', 1) }}">
                @error('guests')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Price Preview --}}
        <div id="pricePreview" style="display:none; background:#e8f0fe; border-radius:10px; padding:16px 20px; border-left:4px solid #1a73e8; margin-bottom:20px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small mb-1">Estimated Total</div>
                    <div id="totalDisplay" style="font-size:1.4rem; font-weight:800; color:#1a73e8;">$0.00</div>
                    <div class="text-muted small" id="nightsDisplay"></div>
                </div>
                <i class="bi bi-calculator fs-2 text-primary opacity-50"></i>
            </div>
        </div>
        <input type="hidden" name="total_price" id="totalPrice">

        <div class="section-divider">Status & Payment</div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
    <label class="form-label">Booking Status <span class="text-danger">*</span></label>

    <select name="status" class="form-select @error('status') is-invalid @enderror">
        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
        <option value="checked_in" {{ old('status') == 'checked_in' ? 'selected' : '' }}>Checked In</option>
        <option value="checked_out" {{ old('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
           <div class="col-md-6">
    <label class="form-label">Payment Status <span class="text-danger">*</span></label>

    <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror">
        <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
        <option value="partial" {{ old('payment_status') == 'partial' ? 'selected' : '' }}>Partial</option>
        <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
    </select>

    @error('payment_status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        <div class="mb-4">
            <label class="form-label">Special Requests / Notes</label>
            <textarea name="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-save"><i class="bi bi-save me-1"></i> Save Booking</button>
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
        if (!price || isNaN(d1) || isNaN(d2) || d2 <= d1) { document.getElementById('pricePreview').style.display='none'; return; }
        const nights = Math.ceil((d2 - d1) / 86400000);
        const total = nights * price;
        document.getElementById('totalDisplay').textContent = '$' + total.toFixed(2);
        document.getElementById('nightsDisplay').textContent = nights + ' night(s) × $' + price.toFixed(2);
        document.getElementById('totalPrice').value = total.toFixed(2);
        document.getElementById('pricePreview').style.display = 'block';
    }
    [roomSel, ci, co].forEach(el => el.addEventListener('change', calcTotal));
    ci.addEventListener('change', () => { co.min = ci.value; calcTotal(); });
    document.getElementById('customerSelect').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        const info = document.getElementById('customerInfo');
        if (opt.value) {
            document.getElementById('previewPhone').value = opt.dataset.phone || '';
            document.getElementById('previewEmail').value = opt.dataset.email || '';
            info.style.display = 'flex';
        } else { info.style.display = 'none'; }
    });

const roomSelect = document.getElementById('roomSelect');
const checkIn = document.getElementById('check_in');
const checkOut = document.getElementById('check_out');
const totalPrice = document.getElementById('totalPrice');

function calculatePrice() {
    const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
    const pricePerNight = parseFloat(selectedRoom?.dataset.price || 0);

    const inDate = new Date(checkIn.value);
    const outDate = new Date(checkOut.value);

    if (!pricePerNight || !checkIn.value || !checkOut.value) {
        totalPrice.value = '';
        return;
    }

    const diffTime = outDate - inDate;
    const nights = diffTime / (1000 * 60 * 60 * 24);

    if (nights > 0) {
        totalPrice.value = '$' + (nights * pricePerNight).toFixed(2);
    } else {
        totalPrice.value = '';
    }
}

roomSelect.addEventListener('change', calculatePrice);
checkIn.addEventListener('change', calculatePrice);
checkOut.addEventListener('change', calculatePrice);
</script>
@endpush