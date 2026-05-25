@extends('layouts.app')
@section('title', 'Payment Management')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#1a73e8,#4a9df8);">
                <div class="number">{{ $totalBookings }}</div>
                <div class="label"><i class="bi bi-credit-card me-1"></i>Total Bookings</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#28a745,#48c76a);">
                <div class="number">${{ number_format($totalPaid, 2) }}</div>
                <div class="label"><i class="bi bi-check-circle me-1"></i>Total Paid</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#ffc107,#ffda6a);">
                <div class="number" style="color:#000;">${{ number_format($totalUnpaid, 2) }}</div>
                <div class="label" style="color:#000;"><i class="bi bi-hourglass-split me-1"></i>Unpaid</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#fd7e14,#ffb347);">
                <div class="number">${{ number_format($totalPartial, 2) }}</div>
                <div class="label"><i class="bi bi-pie-chart me-1"></i>Partial</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Payment Management</h2>
            <input type="text" class="form-control search-input" id="searchInput" placeholder="Search payment...">
        </div>

        <div class="table-responsive">
            <table class="table table-borderless rounded overflow-hidden" id="paymentTable">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Room</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td><strong>#{{ $booking->id }}</strong></td>
                        <td>
                            <div class="fw-semibold">{{ $booking->customer->name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $booking->customer->phone ?? '' }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Room {{ $booking->room->room_number ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $booking->room->type ?? '' }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
                        <td><strong>${{ number_format($booking->total_price, 2) }}</strong></td>
                        <td>
                            @if($booking->payment_status === 'Paid')
                                <span class="badge badge-paid rounded-pill px-3 py-2">Paid</span>
                            @elseif($booking->payment_status === 'Partial')
                                <span class="badge badge-partial rounded-pill px-3 py-2">Partial</span>
                            @else
                                <span class="badge badge-unpaid rounded-pill px-3 py-2">Unpaid</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status === 'Confirmed')
                                <span class="badge badge-confirmed rounded-pill px-3 py-2">Confirmed</span>
                            @elseif($booking->status === 'Checked In')
                                <span class="badge badge-checkedin rounded-pill px-3 py-2">Checked In</span>
                            @elseif($booking->status === 'Checked Out')
                                <span class="badge badge-checkedout rounded-pill px-3 py-2">Checked Out</span>
                            @elseif($booking->status === 'Cancelled')
                                <span class="badge badge-cancelled rounded-pill px-3 py-2">Cancelled</span>
                            @else
                                <span class="badge badge-pending rounded-pill px-3 py-2">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->payment_status !== 'Paid')
                                <button type="button" class="btn btn-success btn-sm px-3"
                                    onclick="openPayModal(
                                        {{ $booking->id }},
                                        '{{ addslashes($booking->customer->name ?? 'N/A') }}',
                                        '{{ $booking->room->room_number ?? 'N/A' }}',
                                        {{ $booking->total_price }}
                                    )">
                                    <i class="bi bi-cash-coin me-1"></i> Pay Now
                                </button>
                            @else
                                <span class="text-success fw-semibold">
                                    <i class="bi bi-check-circle-fill me-1"></i> Paid
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">{{ $bookings->links() }}</div>
    </div>

    {{-- ── Pay Modal ── --}}
    <div class="modal fade" id="payModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; border:none;">
                <div class="modal-header" style="background:#1a73e8; border-radius:16px 16px 0 0;">
                    <h5 class="modal-title text-white fw-bold">
                        <i class="bi bi-cash-coin me-2"></i>Process Payment
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form id="payForm" action="" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-body p-4">

                        {{-- Booking Info Summary --}}
                        <div style="background:#f0f4f8; border-radius:10px; padding:14px 18px; margin-bottom:20px;">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Customer</span>
                                <span class="fw-semibold" id="modalCustomer"></span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Room</span>
                                <span class="fw-semibold" id="modalRoom"></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Total Bill</span>
                                <span class="fw-bold text-primary fs-5" id="modalTotal"></span>
                            </div>
                        </div>

                        {{-- Amount --}}
                        <div class="mb-3">
                            <label class="form-label">Amount to Pay ($) <span class="text-danger">*</span></label>
                            <input type="number" name="amount" id="modalAmount"
                                   class="form-control" step="0.01" min="0"
                                   placeholder="Enter amount...">
                        </div>

                        {{-- Payment Method --}}
                        <div class="mb-3">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <select name="method" class="form-select">
                                <option value="Cash">💵 Cash</option>
                                <option value="Credit Card">💳 Credit Card</option>
                                <option value="Bank Transfer">🏦 Bank Transfer</option>
                                <option value="Online">📱 Online</option>
                            </select>
                        </div>

                        {{-- Payment Status --}}
                        <div class="mb-3">
                            <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                            <select name="payment_status" class="form-select">
                                <option value="Paid">✅ Paid (Full)</option>
                                <option value="Partial">⚠️ Partial</option>
                            </select>
                        </div>

                        {{-- Transaction ID --}}
                        <div class="mb-3">
                            <label class="form-label">Transaction ID <span class="text-muted small">(optional)</span></label>
                            <input type="text" name="transaction_id" class="form-control"
                                   placeholder="e.g. TXN-20260524">
                        </div>

                        {{-- Notes --}}
                        <div class="mb-1">
                            <label class="form-label">Notes <span class="text-muted small">(optional)</span></label>
                            <textarea name="notes" rows="2" class="form-control"
                                      placeholder="Any additional notes..."></textarea>
                        </div>

                    </div>

                    <div class="modal-footer" style="border:none;">
                        <button type="button" class="btn btn-outline-secondary btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-save px-4">
                            <i class="bi bi-save me-1"></i> Save Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const val = this.value.toLowerCase();
        document.querySelectorAll('#paymentTable tbody tr').forEach(r => {
            r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });

    function openPayModal(bookingId, customer, room, total) {
        document.getElementById('modalCustomer').textContent = customer;
        document.getElementById('modalRoom').textContent     = 'Room ' + room;
        document.getElementById('modalTotal').textContent    = '$' + parseFloat(total).toFixed(2);
        document.getElementById('modalAmount').value         = parseFloat(total).toFixed(2);
        document.getElementById('payForm').action            = '/payments/' + bookingId + '/pay';
        new bootstrap.Modal(document.getElementById('payModal')).show();
    }
</script>
@endpush