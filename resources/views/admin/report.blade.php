<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

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

        .cards{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .card h3{
            color:#64748b;
            margin-bottom:10px;
        }

        .card h1{
            color:#2563eb;
        }

        .report-table{
            background:white;
            border-radius:10px;
            overflow:hidden;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#2563eb;
            color:white;
        }

        th, td{
            padding:15px;
            border-bottom:1px solid #ddd;
            text-align:left;
        }

        .status{
            padding:6px 12px;
            border-radius:20px;
            color:white;
            font-size:14px;
        }

        .success{
            background:green;
        }

        .pending{
            background:#f59e0b;
        }

        .export-btn{
            margin-top:20px;
            display:inline-block;
            padding:12px 20px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

    </style>
</head>
<body>

    <div class="sidebar">

        <h2>SmartStay</h2>

        <ul>
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/rooms">Rooms</a></li>
            <li><a href="/calendar">Calendar</a></li>
            <li><a href="/customers">Customers</a></li>
            <li><a href="/payments">Payments</a></li>
            <li><a href="/reports">Reports</a></li>
        </ul>

    </div>

    <div class="main">

        <div class="topbar">
            <h1>Hotel Reports</h1>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Total Rooms</h3>
                <h1>50</h1>
            </div>

            <div class="card">
                <h3>Total Customers</h3>
                <h1>120</h1>
            </div>

            <div class="card">
                <h3>Total Bookings</h3>
                <h1>85</h1>
            </div>

            <div class="card">
                <h3>Total Revenue</h3>
                <h1>$12,500</h1>
            </div>

        </div>
        <div class="report-table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>John Smith</td>
                    <td>VIP Room</td>
                    <td>2026-05-08</td>
                    <td>$150</td>
                    <td>
                        <span class="status success">
                            Completed
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Emma Watson</td>
                    <td>Single Room</td>
                    <td>2026-05-09</td>
                    <td>$80</td>
                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>
                </tr>

            </table>

        </div>

        <a href="" class="export-btn">
            Export Report
        </a>
    </div>
</body>
</html>