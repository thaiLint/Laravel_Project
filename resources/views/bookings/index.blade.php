@extends('layouts.app')
@section('title', 'Booking Management')

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
                <div class="number">{{ $totalBookings ?? 0 }}</div>
                <div class="label"><i class="bi bi-calendar2-check me-1"></i>Total Bookings</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#28a745,#48c76a);">
                <div class="number">{{ $checkedIn ?? 0 }}</div>
                <div class="label"><i class="bi bi-door-open me-1"></i>Checked In</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#ffc107,#ffda6a);">
                <div class="number" style="color:#000;">{{ $pending ?? 0 }}</div>
                <div class="label" style="color:#000;"><i class="bi bi-hourglass-split me-1"></i>Pending</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background:linear-gradient(135deg,#dc3545,#f06674);">
                <div class="number">{{ $cancelled ?? 0 }}</div>
                <div class="label"><i class="bi bi-x-circle me-1"></i>Cancelled</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Booking Management</h2>
            <div class="d-flex gap-3 align-items-center">
                <input type="text" class="form-control search-input" id="searchInput" placeholder="Search booking...">
                <a href="{{ route('bookings.create') }}" class="btn btn-add px-4">
                    <i class="bi bi-plus-lg me-1"></i> Add Booking
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless rounded overflow-hidden" id="bookingTable">
                <thead>
                    <tr>
                        <th>ID</th><th>Customer</th><th>Room</th><th>Check-In</th>
                        <th>Check-Out</th><th>Guests</th><th>Total ($)</th>
                        <th>Payment</th><th>Status</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>
                            <div class="fw-semibold">{{ $booking->customer->name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $booking->customer->phone ?? '' }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $booking->room->room_number ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $booking->room->type ?? '' }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
                        <td>{{ $booking->guests }}</td>
                        <td>${{ number_format($booking->total_price, 2) }}</td>
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
                       {{-- Status badge --}}
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
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm px-3">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Delete this booking?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    <i class="bi bi-trash-fill"></i> Cancel
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">{{ $bookings->links() }}</div>
    </div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const val = this.value.toLowerCase();
        document.querySelectorAll('#bookingTable tbody tr').forEach(r => {
            r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush