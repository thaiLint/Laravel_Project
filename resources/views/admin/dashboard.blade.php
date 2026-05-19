<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Dashboard</title>

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
            background:#28346e;
            color:white;
            padding:30px 20px;
            position:fixed;
        }

        .logo{
            font-size:28px;
            font-weight:bold;
            margin-bottom:50px;

        }
.menu li a{
    color:white;
    text-decoration:none;
    font-size:18px;
    display:flex;
    align-items:center;
    padding:10px 10px;
    border-radius:12px;
    transition:0.3s;
}
.menu li a:hover{
    background:#fffffff5;
    color:#28346e;
    transform:translateX(8px);
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
        .menu{
            list-style:none;
        }

        .menu li{
            margin:25px 0;
        }

        .menu li a{
            color:white;
            text-decoration:none;
            font-size:18px;
        }

        .bottom-menu{
            position:absolute;
            bottom:30px;
        }

        .main{
            margin-left:250px;
            width:100%;
            padding:30px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .search{
            width:350px;
            padding:14px;
            border:none;
            border-radius:10px;
            background:#e2e8f0;
            font-size:16px;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .profile img{
            width:45px;
            height:45px;
            border-radius:50%;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        .card-top{
            background:#dbe4ff;
            padding:15px;
            text-align:center;
            font-size:20px;
        }

        .card-body{
            padding:30px;
            text-align:center;
        }

        .card-body h1{
            font-size:55px;
            color:#28346e;
        }

        .content{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:20px;
        }

        .chart-box{
            background:white;
            border-radius:20px;
            padding:20px;
            height:300px;
        }

        .chart{
            height:220px;
            margin-top:20px;
            display:flex;
            align-items:flex-end;
            gap:15px;
        }

        .bar{
            width:40px;
            background:#4f46e5;
            border-radius:10px 10px 0 0;
        }

        .tasks{
            margin-top:20px;
            background:white;
            border-radius:20px;
            padding:20px;
        }

        .task-grid{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:20px;
            margin-top:20px;
        }

        .task-item{
            display:flex;
            justify-content:space-between;
        }

        .small-card{
            background:white;
            border-radius:20px;
            padding:20px;
        }

        .small-chart{
            display:flex;
            align-items:flex-end;
            justify-content:center;
            gap:15px;
            height:200px;
            margin-top:20px;
        }

        .small-bar{
            width:45px;
            background:#28346e;
            border-radius:10px 10px 0 0;
        }
        @media(max-width:1200px){

    .cards{
        grid-template-columns:repeat(2,1fr);
    }

    .content{
        grid-template-columns:1fr;
    }

}

@media(max-width:768px){

    body{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
    }

    .main{
        margin-left:0;
        padding:20px;
    }

    .topbar{
        flex-direction:column;
        gap:20px;
        align-items:flex-start;
    }

    .search{
        width:100%;
    }

    .cards{
        grid-template-columns:1fr;
    }

    .chart{
        gap:8px;
    }

    .bar{
        width:25px;
    }

    .small-chart{
        height:150px;
    }

    .small-bar{
        width:30px;
    }

    .task-grid{
        grid-template-columns:1fr;
    }

}

@media(max-width:500px){

    .logo{
        font-size:22px;
    }

    .menu li a{
        font-size:16px;
    }

    .card-body h1{
        font-size:40px;
    }

    .chart-box,
    .tasks,
    .small-card{
        padding:15px;
    }

}

    </style>
</head>
<body>

    <div class="sidebar">

        <div class="logo">
            SmartStay
        </div>

        <ul class="menu">
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/admin/room">Rooms</a></li>
            <li><a href="/admin/customer">Customers</a></li>
            <li><a href="/admin/payment">Payments</a></li>
            <li><a href="/admin/calendar">Booking</a></li>
            <li><a href="/report">Reports</a></li>
        </ul>

        <div class="bottom-menu">
            <a href="" style="color:white;text-decoration:none;font-size:18px;">
                Settings
            </a>
        </div>

    </div>

    <div class="main">

        <div class="topbar">

            <input type="text" placeholder="Search..." class="search">

            <div class="profile">

                <img src="https://i.pinimg.com/736x/3a/df/b8/3adfb8ae9f81e08ba95be604944e22b6.jpg">

                <h3>Admin</h3>

            </div>

        </div>

        <div class="cards">

            <div class="card">

                <div class="card-top">
                    Total Rooms
                </div>

                <div class="card-body">
                    <h1>50</h1>
                </div>

            </div>

            <div class="card">

                <div class="card-top">
                    Customers
                </div>

                <div class="card-body">
                    <h1>120</h1>
                </div>

            </div>

            <div class="card">

                <div class="card-top">
                    Bookings
                </div>

                <div class="card-body">
                    <h1>89</h1>
                </div>

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

    </div>

</body>
</html>