<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Calendar</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f1f5f9;
            display:flex;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#0f172a;
            color:white;
            position:fixed;
            padding:20px;
        }

        .sidebar h2{
            margin-bottom:40px;
        }

        .sidebar ul{
            list-style:none;
        }

        .sidebar ul li{
            margin:20px 0;
        }

        .sidebar ul li a{
            color:white;
            text-decoration:none;
            font-size:18px;
        }

        .main{
            margin-left:250px;
            width:100%;
            padding:30px;
        }

        .topbar{
            background:white;
            padding:20px;
            border-radius:10px;
            margin-bottom:30px;
        }

        .calendar{
            background:white;
            padding:20px;
            border-radius:10px;
        }

        .month{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .days{
            display:grid;
            grid-template-columns:repeat(7,1fr);
            gap:10px;
        }

        .day-name{
            font-weight:bold;
            text-align:center;
            padding:10px;
        }

        .day{
            background:#e2e8f0;
            height:100px;
            border-radius:10px;
            padding:10px;
            position:relative;
        }

        .booked{
            background:#fecaca;
        }

        .available{
            background:#bbf7d0;
        }

        .booking-label{
            position:absolute;
            bottom:10px;
            left:10px;
            right:10px;
            background:#2563eb;
            color:white;
            padding:5px;
            border-radius:5px;
            font-size:12px;
            text-align:center;
        }

    </style>
</head>
<body>

    <div class="sidebar">

        <h2>SmartStay</h2>

        <ul>
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/rooms">Rooms</a></li>
            <li><a href="/calendar">Booking Calendar</a></li>
            <li><a href="">Customers</a></li>
            <li><a href="">Payments</a></li>
        </ul>

    </div>

    <div class="main">

        <div class="topbar">
            <h1>Booking Calendar</h1>
        </div>

        <div class="calendar">

            <div class="month">
                <h2>May 2026</h2>
                <h3>Hotel Booking Schedule</h3>
            </div>

            <div class="days">

                <div class="day-name">Sun</div>
                <div class="day-name">Mon</div>
                <div class="day-name">Tue</div>
                <div class="day-name">Wed</div>
                <div class="day-name">Thu</div>
                <div class="day-name">Fri</div>
                <div class="day-name">Sat</div>

                <div class="day"></div>
                <div class="day"></div>

                <div class="day available">
                    1
                </div>

                <div class="day booked">
                    2
                    <div class="booking-label">
                        Room 101 Booked
                    </div>
                </div>

                <div class="day available">
                    3
                </div>

                <div class="day booked">
                    4
                    <div class="booking-label">
                        VIP Room Reserved
                    </div>
                </div>

                <div class="day available">
                    5
                </div>

                <div class="day available">6</div>
                <div class="day booked">
                    7
                    <div class="booking-label">
                        Single Room
                    </div>
                </div>

                <div class="day available">8</div>
                <div class="day available">9</div>
                <div class="day booked">10</div>
                <div class="day available">11</div>
                <div class="day available">12</div>
            </div>
        </div>
    </div>
</body>
</html>