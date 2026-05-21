<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width:250px; min-height:100vh;">
            <a href="/" class="d-flex align-items-center mb-4 text-white text-decoration-none fw-bold fs-5">
                <i class="bi bi-building me-2"></i> SmartStay
            </a>
            <ul class="nav nav-pills flex-column mb-auto gap-1">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link text-white">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rooms" class="nav-link text-white">
                        <i class="bi bi-door-closed me-2"></i>Rooms
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/calendar" class="nav-link text-white">
                        <i class="bi bi-calendar3 me-2"></i>Booking Calendar
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/customers" class="nav-link active">
                        <i class="bi bi-people me-2"></i>Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">
                        <i class="bi bi-credit-card me-2"></i>Payments
                    </a>
                </li>
            </ul>
            <div class="mt-auto border-top pt-3">
                <a href="" class="nav-link text-white-50">
                    <i class="bi bi-box-arrow-left me-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">

            <!-- Topbar -->
            <div class="bg-white rounded-3 p-3 d-flex justify-content-between align-items-center mb-4 shadow-sm">
                <div>
                    <h5 class="fw-semibold mb-0">Customer Management</h5>
                    <small class="text-muted">Manage your hotel guests</small>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div class="input-group" style="width:240px;">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Search customer...">
                    </div>
                    <a href="" class="btn btn-primary d-flex align-items-center gap-1">
                        <i class="bi bi-plus-lg"></i> Add Customer
                    </a>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th class="ps-4">#ID</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 text-muted fw-medium">1</td>
                                    <td>
                                        <img src="https://i.pinimg.com/736x/51/d1/5a/51d15a1d63486c1dccb625a78d19442e.jpg"
                                            class="rounded-circle object-fit-cover" width="50" height="50">
                                    </td>
                                    <td class="fw-medium">Thai Lineth</td>
                                    <td class="text-muted">Lineth168@gmail.com</td>
                                    <td class="text-muted">012345678</td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary fw-normal px-3 py-2">VIP Room</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                            <i class="bi bi-circle-fill me-1" style="font-size:8px;"></i>Active
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-warning btn-sm text-white me-1">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4 text-muted fw-medium">2</td>
                                    <td>
                                        <img src="https://i.pinimg.com/736x/f9/28/ae/f928aeb9431bcb435dfbd7543d025663.jpg"
                                            class="rounded-circle object-fit-cover" width="50" height="50">
                                    </td>
                                    <td class="fw-medium">Tham ChanThy</td>
                                    <td class="text-muted">thythy168@gmail.com</td>
                                    <td class="text-muted">098765432</td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary fw-normal px-3 py-2">Single Room</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">
                                            <i class="bi bi-circle-fill me-1" style="font-size:8px;"></i>Checked Out
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-warning btn-sm text-white me-1">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <a href="" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">
                    <small class="text-muted">Showing 1–2 of 2 customers</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>