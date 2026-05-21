@extends('layouts.app')

@section('content')

<div class="topbar">

    <input type="text" placeholder="Search..." class="search">

    <div class="profile">
        <img src="https://i.pinimg.com/736x/3a/df/b8/3adfb8ae9f81e08ba95be604944e22b6.jpg">
        <h3>Admin</h3>
    </div>

</div>

<div class="cards">

    <div class="card">
        <div class="card-top">Total Rooms</div>
        <div class="card-body"><h1>50</h1></div>
    </div>

    <div class="card">
        <div class="card-top">Customers</div>
        <div class="card-body"><h1>120</h1></div>
    </div>

    <div class="card">
        <div class="card-top">Bookings</div>
        <div class="card-body"><h1>89</h1></div>
    </div>

</div>

<div class="content">

    <div>

        <div class="chart-box">

            <h3>Monthly Revenue</h3>

            <div class="chart">
                <div class="bar" style="height:40px;"></div>
                <div class="bar" style="height:80px;"></div>
                <div class="bar" style="height:100px;"></div>
                <div class="bar" style="height:140px;"></div>
                <div class="bar" style="height:120px;"></div>
                <div class="bar" style="height:180px;"></div>
                <div class="bar" style="height:220px;"></div>
            </div>

        </div>

        <div class="tasks">

            <h3>Hotel Tasks</h3>

            <div class="task-grid">

                <div class="task-item">
                    <span>Clean VIP Room</span>
                    <input type="checkbox">
                </div>

                <div class="task-item">
                    <span>Customer Checkout</span>
                    <input type="checkbox">
                </div>

                <div class="task-item">
                    <span>Room Inspection</span>
                    <input type="checkbox">
                </div>

                <div class="task-item">
                    <span>Payment Update</span>
                    <input type="checkbox">
                </div>

            </div>

        </div>

    </div>

    <div class="small-card">

        <h3>Booking Stats</h3>

        <div class="small-chart">

            <div class="small-bar" style="height:80px;"></div>
            <div class="small-bar" style="height:140px;"></div>
            <div class="small-bar" style="height:180px;"></div>

        </div>

    </div>

</div>

@endsection