@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f4f8; }
        .table thead { background-color: #1a73e8; color: white; }
        .table thead th { font-weight: 500; border: none; padding: 14px 16px; }
        .table tbody tr { background: #fff; }
        .table tbody td { vertical-align: middle; padding: 14px 16px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .btn-add { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 500; }
        .btn-add:hover { background-color: #155cb5; color: #fff; }
        .search-input { border-radius: 8px; border: 1px solid #cdd5e0; width: 280px; }
        .page-title { font-weight: 800; font-size: 1.8rem; }

        /* Status badges */
        .badge-confirmed   { background-color: #1a73e8; }
        .badge-checkedin   { background-color: #28a745; }
        .badge-checkedout  { background-color: #6c757d; }
        .badge-cancelled   { background-color: #dc3545; }
        .badge-pending     { background-color: #ffc107; color: #000 !important; }

        /* Payment badges */
        .badge-paid        { background-color: #28a745; }
        .badge-unpaid      { background-color: #dc3545; }
        .badge-partial     { background-color: #fd7e14; }

        /* Summary cards */
        .summary-card { border: none; border-radius: 10px; padding: 18px 22px; color: #fff; }
        .summary-card .number { font-size: 1.9rem; font-weight: 800; }
        .summary-card .label  { font-size: 0.85rem; opacity: 0.9; }
    </style>
</head>
<body>

<div class="container py-5">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background: linear-gradient(135deg,#1a73e8,#4a9df8);">
                <div class="number">{{ $totalBookings ?? 0 }}</div>
                <div class="label"><i class="bi bi-calendar2-check me-1"></i>Total Bookings</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background: linear-gradient(135deg,#28a745,#48c76a);">
                <div class="number">{{ $checkedIn ?? 0 }}</div>
                <div class="label"><i class="bi bi-door-open me-1"></i>Checked In</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background: linear-gradient(135deg,#ffc107,#ffda6a);">
                <div class="number" style="color:#000;">{{ $pending ?? 0 }}</div>
                <div class="label" style="color:#000;"><i class="bi bi-hourglass-split me-1"></i>Pending</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card" style="background: linear-gradient(135deg,#dc3545,#f06674);">
                <div class="number">{{ $cancelled ?? 0 }}</div>
                <div class="label"><i class="bi bi-x-circle me-1"></i>Cancelled</div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Booking Management</h2>
            <div class="d-flex gap-3 align-items-center">
                <input type="text" class="form-control search-input" id="searchInput" placeholder="Search booking...">
                <a href="{{ route('bookings.create') }}" class="btn btn-add px-4">
                    <i class="bi bi-plus-lg me-1"></i> Add Booking
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-borderless rounded overflow-hidden" id="bookingTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Room</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Guests</th>
                        <th>Total ($)</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>
                            <div class="fw-semibold">{{ $booking->customer->name ?? $booking->customer_name }}</div>
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
                            @php $pay = $booking->payment_status; @endphp
                            @if($pay === 'Paid')
                                <span class="badge badge-paid rounded-pill px-3 py-2">Paid</span>
                            @elseif($pay === 'Partial')
                                <span class="badge badge-partial rounded-pill px-3 py-2">Partial</span>
                            @else
                                <span class="badge badge-unpaid rounded-pill px-3 py-2">Unpaid</span>
                            @endif
                        </td>
                        <td>
                            @php $st = $booking->status; @endphp
                            @if($st === 'Confirmed')
                                <span class="badge badge-confirmed rounded-pill px-3 py-2">Confirmed</span>
                            @elseif($st === 'Checked In')
                                <span class="badge badge-checkedin rounded-pill px-3 py-2">Checked In</span>
                            @elseif($st === 'Checked Out')
                                <span class="badge badge-checkedout rounded-pill px-3 py-2">Checked Out</span>
                            @elseif($st === 'Cancelled')
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
                                  class="d-inline"
                                  onsubmit="return confirm('Delete this booking?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    <i class="bi bi-trash-fill"></i> Delete
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

        {{-- Pagination --}}
        <div class="d-flex justify-content-end mt-3">
            {{ $bookings->links() }}
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#bookingTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
</body>
</html>