<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>

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
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .search-box{
            padding:10px;
            width:250px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        .add-btn{
            background:#2563eb;
            color:white;
            padding:12px 20px;
            border:none;
            border-radius:5px;
            text-decoration:none;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:10px;
            overflow:hidden;
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

        .paid{
            background:green;
        }

        .pending{
            background:#f59e0b;
        }

        .invoice{
            background:#2563eb;
            color:white;
            padding:8px 12px;
            border-radius:5px;
            text-decoration:none;
        }

        .delete{
            background:#dc2626;
            color:white;
            padding:8px 12px;
            border-radius:5px;
            text-decoration:none;
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
            <li><a href="/customers">Customers</a></li>
            <li><a href="/payments">Payments</a></li>
            <li><a href="">Logout</a></li>
        </ul>

    </div>

    <div class="main">

        <div class="topbar">

            <h1>Payment Management</h1>

            <div>
                <input type="text" placeholder="Search payment..." class="search-box">

                <a href="" class="add-btn">
                    + Add Payment
                </a>
            </div>

        </div>

        <table>

            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Room</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <tr>

                <td>1</td>

                <td>John Smith</td>

                <td>VIP Room</td>

                <td>$150</td>

                <td>Credit Card</td>

                <td>2026-05-08</td>

                <td>
                    <span class="status paid">
                        Paid
                    </span>
                </td>

                <td>
                    <a href="" class="invoice">Invoice</a>
                    <a href="" class="delete">Delete</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Emma Watson</td>
                <td>Single Room</td>
                <td>$80</td>
                <td>Cash</td>
                <td>2026-05-09</td>
                <td>
                    <span class="status pending">
                        Pending
                    </span>
                </td>
                <td>
                    <a href="" class="invoice">Invoice</a>
                    <a href="" class="delete">Delete</a>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>