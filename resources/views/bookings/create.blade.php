<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Booking</title>
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
        .price-preview { background: #e8f0fe; border-radius: 10px; padding: 16px 20px; border-left: 4px solid #1a73e8; }
        .price-preview .total { font-size: 1.4rem; font-weight: 800; color: #1a73e8; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card p-4" style="max-width: 860px; margin: auto;">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">
                <i class="bi bi-calendar2-plus me-2 text-primary"></i>Add New Booking
            </h2>
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-cancel">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            {{-- Customer & Room --}}
            <div class="section-divider">Customer & Room</div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Customer <span class="text-danger">*</span></label>
                    <select name="customer_id" id="customerSelect"
                            class="form-select @error('customer_id') is-invalid @enderror">
                        <option value="">-- Select Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}"
                                    data-phone="{{ $customer->phone }}"
                                    data-email="{{ $customer->email }}"
                                {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Room <span class="text-danger">*</span></label>
                    <select name="room_id" id="roomSelect"
                            class="form-select @error('room_id') is-invalid @enderror">
                        <option value="">-- Select Room --</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}"
                                    data-price="{{ $room->price_per_night }}"
                                    data-type="{{ $room->type }}"
                                {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                Room {{ $room->room_number }} — {{ $room->type }} (${{ $room->price_per_night }}/night)
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Customer Info Preview --}}
            <div class="row g-3 mb-3" id="customerInfo" style="display:none !important;">
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control bg-light" id="previewPhone" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control bg-light" id="previewEmail" readonly>
                </div>
            </div>

            {{-- Dates & Guests --}}
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
                    <input type="number" name="guests" min="1" max="20"
                           class="form-control @error('guests') is-invalid @enderror"
                           value="{{ old('guests', 1) }}">
                    @error('guests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Price Preview --}}
            <div class="price-preview mb-4" id="pricePreview" style="display:none;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Estimated Total</div>
                        <div class="total" id="totalDisplay">$0.00</div>
                        <div class="text-muted small" id="nightsDisplay"></div>
                    </div>
                    <i class="bi bi-calculator fs-2 text-primary opacity-50"></i>
                </div>
            </div>
            <input type="hidden" name="total_price" id="totalPrice">

            {{-- Status & Payment --}}
            <div class="section-divider">Status & Payment</div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Booking Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        @foreach(['Pending','Confirmed','Checked In','Checked Out','Cancelled'] as $s)
                            <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                    <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror">
                        @foreach(['Unpaid','Partial','Paid'] as $p)
                            <option value="{{ $p }}" {{ old('payment_status') == $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                    @error('payment_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Special Requests --}}
            <div class="mb-4">
                <label class="form-label">Special Requests / Notes</label>
                <textarea name="notes" rows="3" class="form-control"
                          placeholder="e.g. Late check-in, extra bed, allergies...">{{ old('notes') }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-save">
                    <i class="bi bi-save me-1"></i> Save Booking
                </button>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const roomSelect  = document.getElementById('roomSelect');
    const checkIn     = document.getElementById('checkIn');
    const checkOut    = document.getElementById('checkOut');
    const pricePreview= document.getElementById('pricePreview');
    const totalDisplay= document.getElementById('totalDisplay');
    const nightsDisplay=document.getElementById('nightsDisplay');
    const totalPrice  = document.getElementById('totalPrice');
    const customerSel = document.getElementById('customerSelect');
    const customerInfo= document.getElementById('customerInfo');

    function calcTotal() {
        const opt = roomSelect.options[roomSelect.selectedIndex];
        const price = parseFloat(opt?.dataset?.price || 0);
        const d1 = new Date(checkIn.value), d2 = new Date(checkOut.value);
        if (!price || isNaN(d1) || isNaN(d2) || d2 <= d1) { pricePreview.style.display='none'; return; }
        const nights = Math.ceil((d2 - d1) / 86400000);
        const total  = nights * price;
        totalDisplay.textContent  = '$' + total.toFixed(2);
        nightsDisplay.textContent = nights + ' night(s) × $' + price.toFixed(2);
        totalPrice.value          = total.toFixed(2);
        pricePreview.style.display = 'block';
    }

    [roomSelect, checkIn, checkOut].forEach(el => el.addEventListener('change', calcTotal));

    // Check-out must be after check-in
    checkIn.addEventListener('change', () => { checkOut.min = checkIn.value; calcTotal(); });

    // Customer info preview
    customerSel.addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        if (opt.value) {
            document.getElementById('previewPhone').value = opt.dataset.phone || '';
            document.getElementById('previewEmail').value = opt.dataset.email || '';
            customerInfo.style.display = 'flex';
        } else {
            customerInfo.style.display = 'none';
        }
    });
</script>
</body>
</html>