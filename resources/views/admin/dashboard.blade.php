<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            display:flex;
            background:#f1f5f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#0f172a;
            color:white;
            padding:20px;
            position:fixed;
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

        .cards{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-top:30px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .card h1{
            margin-top:10px;
            color:#2563eb;
        }

        .topbar{
            background:white;
            padding:20px;
            border-radius:10px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>SmartStay</h2>
        <ul>
            <li><a href="">Dashboard</a></li>
            <li><a href="">Rooms</a></li>
            <li><a href="">Bookings</a></li>
            <li><a href="">Customers</a></li>
            <li><a href="">Payments</a></li>
            <li><a href="">Reports</a></li>
            <li><a href="">Logout</a></li>
        </ul>

    </div>

    <div class="main">

        <div class="topbar">
            <h1>Admin Dashboard</h1>

            <h3>Welcome Admin</h3>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Total Rooms</h3>
                <h1>50</h1>
            </div>

            <div class="card">
                <h3>Bookings</h3>
                <h1>20</h1>
            </div>

            <div class="card">
                <h3>Customers</h3>
                <h1>100</h1>
            </div>

            <div class="card">
                <h3>Revenue</h3>
                <h1>$5000</h1>
            </div>

        </div>

    </div>

</body>
</html>