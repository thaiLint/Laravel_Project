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