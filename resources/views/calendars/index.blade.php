@extends('layouts.app')

@section('content')

@php
    use Carbon\Carbon;

    $now = Carbon::now();

    $currentMonth = request('month')
    ? Carbon::parse(request('month'))->startOfMonth()
    : Carbon::now()->startOfMonth();
    $startOfMonth   = $currentMonth->copy()->startOfMonth();
    $daysInMonth    = $currentMonth->daysInMonth;
    $startDayOfWeek = $startOfMonth->dayOfWeek;

    $prevMonth = $currentMonth->copy()->subMonth();
    $nextMonth = $currentMonth->copy()->addMonth();

    $daysInPrevMonth = $prevMonth->daysInMonth;

    // Demo data
    $bookings = $bookings ?? [
        6 => [
            'id'    => 1,
            'time'  => '09:00 AM',
            'type'  => 'confirmed',
            'label' => 'Room 101',
        ],

        7 => [
            'id'    => 2,
            'time'  => '01:00 PM',
            'type'  => 'pending',
            'label' => 'Room 202',
        ],

        14 => [
            'id'    => 3,
            'time'  => '04:00 PM',
            'type'  => 'cancelled',
            'label' => 'Room 303',
        ],
    ];

    $typeColors = [
        'confirmed' => [
            'bg'   => '#EAF3DE',
            'text' => '#3B6D11',
            'dot'  => '#3B6D11'
        ],

        'pending' => [
            'bg'   => '#FAEEDA',
            'text' => '#854F0B',
            'dot'  => '#BA7517'
        ],

        'cancelled' => [
            'bg'   => '#FCEBEB',
            'text' => '#A32D2D',
            'dot'  => '#A32D2D'
        ],
    ];

    $pendingCount   = $counts['pending'] ?? 3;
    $confirmedCount = $counts['confirmed'] ?? 12;
    $cancelledCount = $counts['cancelled'] ?? 1;
@endphp

<style>
    *, *::before, *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .cbv-wrap {
        padding: 1.5rem;
        background: #F4F5F7;
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }

    .cbv-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 12px;
    }

    .cbv-header h1 {
        font-size: 22px;
        font-weight: 600;
        color: #111827;
    }

    .view-btns {
        display: flex;
        gap: 6px;
    }

    .vbtn {
        padding: 7px 18px;
        border-radius: 8px;
        border: 1px solid #D1D5DB;
        background: #fff;
        color: #6B7280;
        text-decoration: none;
        font-size: 13px;
    }

    .vbtn.active {
        background: #185FA5;
        color: #fff;
        border-color: #185FA5;
    }

    .cbv-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .cal-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 10px;
    }

    .nav-group {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .nbtn,
    .today-btn {
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background: #F9FAFB;
        text-decoration: none;
        color: #111827;
        font-size: 13px;
    }

    .today-btn {
        background: #EFF6FF;
        border-color: #185FA5;
        color: #185FA5;
    }

    .month-label {
        font-size: 18px;
        font-weight: bold;
    }

    .day-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }

    .day-hdr {
        text-align: center;
        font-size: 12px;
        color: #6B7280;
        padding: 8px 0;
        font-weight: bold;
    }

    .day-cell {
        min-height: 90px;
        border: 1px solid #F3F4F6;
        border-radius: 10px;
        padding: 6px;
        background: #FAFAFA;
        position: relative;
    }

    .day-cell.today {
        background: #EFF6FF;
        border-color: #185FA5;
    }

    .day-cell.faded {
        opacity: .4;
    }

    .day-num {
        font-size: 13px;
        color: #6B7280;
        margin-bottom: 6px;
        display: inline-block;
    }

    .evt {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        padding: 4px 6px;
        border-radius: 6px;
        margin-top: 4px;
    }

    .evt-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 13px;
        color: #6B7280;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #D1D5DB;
        width: 100%;
    }

    .form-actions {
        margin-top: 1rem;
        display: flex;
        gap: 10px;
    }

    .btn-save {
        padding: 10px 20px;
        background: #185FA5;
        color: white;
        border: none;
        border-radius: 8px;
    }

    .btn-cancel {
        padding: 10px 20px;
        background: #F3F4F6;
        border: none;
        border-radius: 8px;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .status-card {
        padding: 1.2rem;
        border-radius: 14px;
    }

    .pending {
        background: #FAEEDA;
    }

    .confirmed {
        background: #EAF3DE;
    }

    .cancelled {
        background: #FCEBEB;
    }

    .status-count {
        font-size: 28px;
        font-weight: bold;
        margin: 8px 0;
    }

    @media(max-width:768px){
        .form-grid,
        .status-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="cbv-wrap">

    {{-- HEADER --}}
    <div class="cbv-header">

        <h1>Calendar View</h1>

       <div class="view-btns">

    <form method="GET" action="{{ route('calendars.index') }}" class="view-btns">

    <input type="date"
           name="month"
           value="{{ request('month') ?? now()->format('Y-m-d') }}"
           class="vbtn">

    <button type="submit" class="vbtn active">
        Check Schedule
    </button>

</form>

</div>

    </div>

    {{-- CALENDAR --}}
    <div class="cbv-card">

        <div class="cal-controls">

            <div class="nav-group">

                <a href="{{ route('calendars.index', ['month' => $prevMonth->format('Y-m')]) }}"
                   class="nbtn">
                    ◀
                </a>

                <a href="{{ route('calendars.index', ['month' => $nextMonth->format('Y-m')]) }}"
                   class="nbtn">
                    ▶
                </a>

                <a href="{{ route('calendars.index') }}"
                   class="today-btn">
                    Today
                </a>

            </div>

            <div class="month-label">
                {{ $currentMonth->format('F Y') }}
            </div>

        </div>

        <div class="day-grid">

            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                <div class="day-hdr">{{ $day }}</div>
            @endforeach

            {{-- Previous Month --}}
            @for($i = $daysInPrevMonth - $startDayOfWeek + 1; $i <= $daysInPrevMonth; $i++)
                @if($startDayOfWeek > 0)
                    <div class="day-cell faded">
                        <span class="day-num">{{ $i }}</span>
                    </div>
                @endif
            @endfor

            {{-- Current Month --}}
            @for($day = 1; $day <= $daysInMonth; $day++)

                @php
                    $isToday = $currentMonth->month == $now->month
                               && $currentMonth->year == $now->year
                               && $day == $now->day;

                    $booking = $bookings[$day] ?? null;
                @endphp

                <div class="day-cell {{ $isToday ? 'today' : '' }}">

                    <span class="day-num">{{ $day }}</span>

                    @if($booking)

                        @php
                            $colors = $typeColors[$booking['type']];
                        @endphp

                        <div class="evt"
                             style="background:{{ $colors['bg'] }}; color:{{ $colors['text'] }}">

                            <span class="evt-dot"
                                  style="background:{{ $colors['dot'] }}">
                            </span>

                            {{ $booking['time'] }}

                        </div>

                    @endif

                </div>

            @endfor

        </div>

    </div>

    {{-- EDIT BOOKING --}}
    <div class="cbv-card">

        <div class="section-title">
            Edit Booking
        </div>

        <form method="POST"
              action="{{ route('bookings.update', $editBooking->id ?? 1) }}">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label>Customer</label>
                    <input type="text"
                           name="customer"
                           value="{{ old('customer', $editBooking->customer ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Service</label>
                    <input type="text"
                           name="service"
                           value="{{ old('service', $editBooking->service ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date"
                           name="date"
                           value="{{ old('date',
                                isset($editBooking)
                                ? \Carbon\Carbon::parse($editBooking->date)->format('Y-m-d')
                                : '') }}">
                </div>

                <div class="form-group">
                    <label>Time</label>
                    <input type="time"
                           name="time"
                           value="{{ old('time', $editBooking->time ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Guests</label>
                    <input type="text"
                           name="guests"
                           value="{{ old('guests', $editBooking->guests ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select name="status">

                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>

                    </select>
                </div>

                <div class="form-group full">
                    <label>Notes</label>

                    <textarea name="notes">{{ old('notes', $editBooking->notes ?? '') }}</textarea>
                </div>

            </div>

            <div class="form-actions">

                <button type="submit" class="btn-save">
                    Save Booking
                </button>

                <button type="button" class="btn-cancel">
                    Cancel
                </button>

            </div>

        </form>

    </div>

    {{-- STATUS --}}
    <div class="status-grid">

        <div class="status-card pending">
            <h3>Pending</h3>
            <div class="status-count">{{ $pendingCount }}</div>
            <p>Awaiting confirmation</p>
        </div>

        <div class="status-card confirmed">
            <h3>Confirmed</h3>
            <div class="status-count">{{ $confirmedCount }}</div>
            <p>Booking confirmed</p>
        </div>

        <div class="status-card cancelled">
            <h3>Cancelled</h3>
            <div class="status-count">{{ $cancelledCount }}</div>
            <p>Booking cancelled</p>
        </div>

    </div>

</div>

@endsection