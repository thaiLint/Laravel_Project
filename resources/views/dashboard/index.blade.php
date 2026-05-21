<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>


    </style>
</head>
<body>

<div class="container-fluid dashboard">

    <!-- Top -->
    <div class="topbar">

        <div class="search-box">
            <input type="text" class="form-control" placeholder="Search...">
        </div>

        <div class="admin">
            <img src="https://i.pravatar.cc/100" alt="">
            <span>Admin</span>
        </div>

    </div>

    <!-- Cards -->
    <div class="row g-4">

        <div class="col-lg-4 col-md-6">
            <div class="stats-card">

                <div class="stats-header">
                    Total Rooms
                </div>

                <div class="stats-body">
                    <div class="stats-number">50</div>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stats-card">

                <div class="stats-header">
                    Customers
                </div>

                <div class="stats-body">
                    <div class="stats-number">120</div>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="stats-card">

                <div class="stats-header">
                    Bookings
                </div>

                <div class="stats-body">
                    <div class="stats-number">89</div>
                </div>

            </div>
        </div>

    </div>

    <!-- Charts -->
    <div class="row mt-4 g-4">

        <div class="col-lg-8">

            <div class="chart-card">

                <div class="chart-title">
                    Monthly Revenue
                </div>

                <div class="bars">

                    <div class="bar" style="height:60px;"></div>
                    <div class="bar" style="height:100px;"></div>
                    <div class="bar" style="height:130px;"></div>
                    <div class="bar" style="height:170px;"></div>
                    <div class="bar" style="height:150px;"></div>
                    <div class="bar" style="height:210px;"></div>
                    <div class="bar" style="height:250px;"></div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="chart-card">

                <div class="chart-title">
                    Booking Stats
                </div>

                <div class="bars justify-content-center">

                    <div class="bar" style="height:100px;"></div>
                    <div class="bar" style="height:160px;"></div>
                    <div class="bar" style="height:220px;"></div>

                </div>

            </div>

        </div>

    </div>

    <!-- Tasks -->
    <div class="task-card">

        <div class="task-title">
            Hotel Tasks
        </div>

        <div class="task-item">
            <span>Clean VIP Room</span>
            <input type="checkbox">
        </div>

        <div class="task-item">
            <span>Customer Checkout</span>
            <input type="checkbox">
        </div>

        <div class="task-item">
            <span>Prepare Breakfast</span>
            <input type="checkbox">
        </div>

    </div>

</div>

</body>
</html>