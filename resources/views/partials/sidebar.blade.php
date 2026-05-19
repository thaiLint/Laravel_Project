<div class="sidebar">

    <div class="logo">
        Hotel Admin
    </div>

   <ul class="menu">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

    <li><a href="{{ route('customers.index') }}">Customers</a></li>
    <li><a href="{{ route('rooms.index') }}">Rooms</a></li>
    <li><a href="{{ route('bookings.index') }}">Booking</a></li>
    <li><a href="{{ route('calendars.index') }}">Calendar</a></li>
</ul>

    <div class="bottom-menu">
        <a href="/admin/settings">Settings</a>
    </div>

</div>