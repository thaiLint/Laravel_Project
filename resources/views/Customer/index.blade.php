@extends('layouts.app')

@section('content')

<div class="topbar" style="background:white;padding:20px;border-radius:10px;display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">

    <h1>Customer Management</h1>

    <div>
        <input type="text" placeholder="Search customer..." style="padding:10px;width:250px;border:1px solid #ccc;border-radius:5px;">

        <a href="#" style="background:#2563eb;color:white;padding:12px 20px;border-radius:5px;text-decoration:none;">
            + Add Customer
        </a>
    </div>

</div>

<table style="width:100%;border-collapse:collapse;background:white;border-radius:10px;overflow:hidden;">

    <tr style="background:#2563eb;color:white;">
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
        <td><img src="https://i.pinimg.com/736x/51/d1/5a/51d15a1d63486c1dccb625a78d19442e.jpg" style="width:60px;height:60px;border-radius:50%;"></td>
        <td>Thai Lineth</td>
        <td>test@gmail.com</td>
        <td>012345678</td>
        <td>VIP Room</td>
        <td><span style="background:green;color:white;padding:6px 12px;border-radius:20px;">Active</span></td>
        <td>
            <a href="#" style="background:#f59e0b;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;">Edit</a>
            <a href="#" style="background:#dc2626;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;">Delete</a>
        </td>
    </tr>

</table>

@endsection