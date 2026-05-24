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
@endphp

<style>
.cbv-wrap {
    padding: 1.5rem;
    background: #F4F5F7;
    min-height: 100vh;
}

.cbv-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    border: 1px solid #E5E7EB;
}

.day-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 6px;
}

.day-cell {
    min-height: 120px;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 6px;
    background: #fafafa;
}

.day-num {
    font-size: 12px;
    font-weight: bold;
    color: #6B7280;
}

.airbnb-event {
    background: #fff;
    border-radius: 8px;
    padding: 5px 6px;
    margin-top: 4px;
    font-size: 11px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    border-left: 4px solid #3B82F6;
    cursor: pointer;
    transition: 0.2s;
}

.airbnb-event:hover {
    transform: scale(1.03);
    box-shadow: 0 6px 14px rgba(0,0,0,0.12);
}

.airbnb-time {
    font-size: 10px;
    font-weight: bold;
    color: #374151;
}

.airbnb-title {
    font-size: 11px;
    color: #111827;
}
</style>

<div class="cbv-wrap">

    <div class="cbv-card">

        <h2>{{ $currentMonth->format('F Y') }}</h2>

        <div class="day-grid">

            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d)
                <div class="day-num">{{ $d }}</div>
            @endforeach

            {{-- EMPTY DAYS --}}
            @for($i = 0; $i < $startDayOfWeek; $i++)
                <div></div>
            @endfor

            {{-- DAYS --}}
            @for($day = 1; $day <= $daysInMonth; $day++)

                @php
                    $dayBookings = $bookings[$day] ?? [];
                    $isToday = $currentMonth->month == $now->month
                        && $currentMonth->year == $now->year
                        && $day == $now->day;
                @endphp

                <div class="day-cell {{ $isToday ? 'today' : '' }}">

                    <div class="day-num">{{ $day }}</div>

                    @foreach($dayBookings as $b)

                        @php
                            $color = match($b['status']) {
                                'confirmed' => '#16a34a',
                                'pending' => '#f59e0b',
                                'cancelled' => '#ef4444',
                                default => '#3b82f6'
                            };
                        @endphp

                        <div class="airbnb-event"
                             style="border-left-color: {{ $color }}">

                            <div class="airbnb-time">
                                {{ $b['time'] }}
                            </div>

                            <div class="airbnb-title">
                                Room {{ $b['room'] }} - {{ $b['name'] }}
                            </div>

                        </div>

                    @endforeach

                </div>

            @endfor

        </div>
    </div>
</div>

@endsection