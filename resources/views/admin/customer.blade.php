<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>

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

        img{
            width:60px;
            height:60px;
            border-radius:50%;
            object-fit:cover;
        }

        .status{
            padding:6px 12px;
            border-radius:20px;
            color:white;
            font-size:14px;
        }

        .active{
            background:green;
        }

        .inactive{
            background:red;
        }

        .edit{
            background:#f59e0b;
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
            <li><a href="">Payments</a></li>
            <li><a href="">Logout</a></li>
        </ul>

    </div>

    <div class="main">

        <div class="topbar">

            <h1>Customer Management</h1>

            <div>
                <input type="text" placeholder="Search customer..." class="search-box">

                <a href="" class="add-btn">
                    + Add Customer
                </a>
            </div>

        </div>

        <table>

            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Room</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <tr>

                <td>1</td>

                <td>
                    <img src="https://i.pinimg.com/736x/51/d1/5a/51d15a1d63486c1dccb625a78d19442e.jpg">
                </td>
                <td>Thai Lineth</td>
                <td>Lineth168@gmail.com</td>
                <td>012345678</td>
                <td>VIP Room</td>
                <td>
                    <span class="status active">
                        Active
                    </span>
                </td>
                <td>
                    <a href="" class="edit">Edit</a>
                    <a href="" class="delete">Delete</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <img src="https://i.pinimg.com/736x/f9/28/ae/f928aeb9431bcb435dfbd7543d025663.jpg">
                </td>

                <td>Tham ChanThy</td>
                <td>thythy168@gmail.com</td>
                <td>098765432</td>
                <td>Single Room</td>
                <td>
                    <span class="status inactive">
                        Checked Out
                    </span>
                </td>
                <td>
                    <a href="" class="edit">Edit</a>
                    <a href="" class="delete">Delete</a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>