<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Admin')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
     @vite('resources/css/app.css')
    <style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
     }


.topbar{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.search{
    width: 300px;
    padding: 12px;
    border: none;
    outline: none;
    border-radius: 12px;
    background: #edf0f7;
    font-size: 15px;
}

.profile{
    display: flex;
    align-items: center;
    gap: 10px;
}

.profile img{
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
}

.profile h3{
    font-size: 18px;
}

/* CARDS */

.cards{
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.card{
    background: white;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.card-top{
    background: #dfe3ff;
    padding: 15px;
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

.card-body{
    padding: 35px;
    text-align: center;
}

.card-body h1{
    font-size: 60px;
    color: #27348b;
}

/* CONTENT */

.content{
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

/* CHART */

.chart-box{
    background: white;
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.chart-box h3{
    margin-bottom: 20px;
}

.chart{
    height: 250px;
    display: flex;
    align-items: end;
    gap: 15px;
}

.bar{
    width: 45px;
    background: #4a4aff;
    border-radius: 10px 10px 0 0;
}

/* TASKS */

.tasks{
    background: white;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.tasks h3{
    margin-bottom: 20px;
}

.task-grid{
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 15px;
}

.task-item{
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f7f8fc;
    padding: 15px;
    border-radius: 12px;
}

/* SMALL CARD */

.small-card{
    background: white;
    padding: 20px;
    border-radius: 20px;
    height: fit-content;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.small-card h3{
    margin-bottom: 25px;
}

.small-chart{
    height: 250px;
    display: flex;
    align-items: end;
    justify-content: center;
    gap: 20px;
}

.small-bar{
    width: 55px;
    background: #27348b;
    border-radius: 10px 10px 0 0;
}

/* RESPONSIVE */

@media(max-width:992px){

    .cards{
        grid-template-columns: repeat(2,1fr);
    }

    .content{
        grid-template-columns: 1fr;
    }

}

@media(max-width:768px){

    .cards{
        grid-template-columns: 1fr;
    }

    .task-grid{
        grid-template-columns: 1fr;
    }

    .search{
        width: 100%;
    }

    .card-body h1{
        font-size: 45px;
    }

    .bar{
        width: 30px;
    }

    .small-bar{
        width: 40px;
    }

}
        
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Arial,sans-serif; }
        body { background:#f1f5f9; display:flex; }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #0f172a;
            color: white;
            position: fixed;
            padding: 20px;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }
        .sidebar h2 { margin-bottom: 40px; font-size: 20px; font-weight: 800; }
        .sidebar ul { list-style: none; flex: 1; }
        .sidebar ul li { margin: 8px 0; }
        .sidebar ul li a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            border-left: 3px solid transparent;
            transition: 0.2s;
        }
        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-left-color: #3b82f6;
        }
        .sidebar .bottom-menu { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); }
        .sidebar .bottom-menu a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            transition: 0.2s;
        }
        .sidebar .bottom-menu a:hover { background: rgba(255,255,255,0.08); color: #fff; }

        .main {
            margin-left: 250px;
            width: 100%;
            padding: 30px;
            min-height: 100vh;
        }

        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        }

        /* Table */
        .table thead { background-color: #1a73e8; color: white; }
        .table thead th { font-weight: 500; border: none; padding: 14px 16px; }
        .table tbody tr { background: #fff; }
        .table tbody td { vertical-align: middle; padding: 14px 16px; }

        /* Badges */
        .badge-available, .badge-active, .badge-paid, .badge-checkedin { background-color: #28a745; }
        .badge-booked, .badge-inactive, .badge-unpaid, .badge-cancelled { background-color: #dc3545; }
        .badge-maintenance, .badge-pending { background-color: #ffc107; color: #000 !important; }
        .badge-confirmed { background-color: #1a73e8; }
        .badge-checkedout { background-color: #6c757d; }
        .badge-partial { background-color: #fd7e14; }

        /* Buttons */
        .btn-add { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 600; }
        .btn-add:hover { background-color: #155cb5; color: #fff; }
        .btn-save { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
        .btn-save:hover { background-color: #155cb5; color: #fff; }
        .btn-update { background-color: #f59e0b; color: #fff; border-radius: 8px; font-weight: 600; padding: 10px 30px; }
        .btn-update:hover { background-color: #d97706; color: #fff; }
        .btn-cancel { border-radius: 8px; padding: 10px 30px; font-weight: 600; }

        /* Forms */
        .form-label { font-weight: 600; color: #444; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cdd5e0; padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: #1a73e8; box-shadow: 0 0 0 0.2rem rgba(26,115,232,0.2); }
        .section-divider {
            color: #1a73e8; font-weight: 700; font-size: 0.85rem;
            text-transform: uppercase; letter-spacing: 1px;
            border-bottom: 2px solid #e8f0fe;
            padding-bottom: 6px; margin-bottom: 18px; margin-top: 10px;
        }
        .search-input { border-radius: 8px; border: 1px solid #cdd5e0; width: 280px; }
        .page-title { font-weight: 800; font-size: 1.8rem; }

        /* Summary cards */
        .summary-card { border: none; border-radius: 12px; padding: 20px 24px; color: #fff; }
        .summary-card .number { font-size: 2rem; font-weight: 800; }
        .summary-card .label  { font-size: 0.85rem; opacity: 0.9; }

        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main { margin-left: 0; }
            body { flex-direction: column; }
        }

    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar">
    <h2><i class="bi bi-building me-2"></i>Hotel Admin</h2>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Customers
            </a>
        </li>
        <li>
            <a href="{{ route('rooms.index') }}" class="{{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                <i class="bi bi-door-open-fill"></i> Rooms
            </a>
        </li>
        <li>
            <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                <i class="bi bi-calendar2-check-fill"></i> Booking
            </a>
        </li>
         <li>
            <a href="{{ route('calendars.index') }}" class="{{ request()->routeIs('calendars.*') ? 'active' : '' }}">
                <i class="bi bi-calendar2-check-fill"></i> Calendar
            </a>
        </li>
    </ul>
    <div class="bottom-menu">
        <a href="#">
            <i class="bi bi-gear-fill"></i> Settings
        </a>
    </div>
</div>

<div class="main">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>