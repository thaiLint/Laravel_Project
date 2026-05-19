@extends('layout')

@section('title', 'Customers')

@section('breadcrumb')
    <a href="#">Dashboard</a>
    <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
    <span>Customers</span>
@endsection

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 class="section-title">Customers</h1>
        <p style="color:#94a3b8; font-size:14px; margin-top:4px;">Manage all registered customers</p>
    </div>
    <a href="{{ route('customers.create') }}" class="btn-primary">
        <i class="fa-solid fa-plus"></i> Add Customer
    </a>
</div>
{{-- Stats Row --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px;">
    <div class="card" style="padding:20px;">
        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Total Customers</p>
        <p style="font-size:28px;font-weight:700;color:#0f172a;margin-top:4px;">{{ $customers->total() ?? count($customers) }}</p>
    </div>
    <div class="card" style="padding:20px;">
        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Active</p>
        <p style="font-size:28px;font-weight:700;color:#16a34a;margin-top:4px;">{{ $customers->where('status','active')->count() }}</p>
    </div>
    <div class="card" style="padding:20px;">
        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Inactive</p>
        <p style="font-size:28px;font-weight:700;color:#dc2626;margin-top:4px;">{{ $customers->where('status','inactive')->count() }}</p>
    </div>
    <div class="card" style="padding:20px;">
        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">This Month</p>
        <p style="font-size:28px;font-weight:700;color:#2563eb;margin-top:4px;">{{ $customers->where('created_at','>=',now()->startOfMonth())->count() }}</p>
    </div>
</div>

{{-- Table Card --}}
<div class="card" style="padding:0; overflow:hidden;">
    {{-- Search & Filter --}}
    <div style="padding:20px 24px; border-bottom:1px solid #f1f5f9; display:flex; gap:12px; align-items:center;">
        <form method="GET" action="{{ route('customers.index') }}" style="display:flex; gap:10px; flex:1;">
            <div style="position:relative; flex:1;">
                <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name, email or phone..."
                    class="form-input" style="padding-left:36px; background:#fff;">
            </div>
            <select name="status" class="form-input" style="width:160px; background:#fff;">
                <option value="">All Status</option>
                <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
                <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
            </select>
            <button type="submit" class="btn-primary">Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('customers.index') }}" class="btn-secondary">Clear</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Joined</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr>
                <td style="color:#94a3b8;">{{ $loop->iteration }}</td>
                <td>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div class="avatar">{{ strtoupper(substr($customer->name,0,2)) }}</div>
                        <div>
                            <p style="font-weight:600;color:#0f172a;margin:0;">{{ $customer->name }}</p>
                            <p style="font-size:12px;color:#94a3b8;margin:0;">ID #{{ $customer->id }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone ?? '—' }}</td>
                <td>
                    <span class="badge {{ $customer->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                        {{ ucfirst($customer->status) }}
                    </span>
                </td>
                <td>{{ $customer->created_at->format('M d, Y') }}</td>
                <td style="text-align:right;">
                    <div style="display:flex; gap:6px; justify-content:flex-end;">
                        <a href="{{ route('customers.show', $customer) }}" class="btn-edit" title="View">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn-edit" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                            onsubmit="return confirm('Delete {{ $customer->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:48px; color:#94a3b8;">
                    <i class="fa-solid fa-users" style="font-size:32px; display:block; margin-bottom:12px; opacity:.3;"></i>
                    No customers found.
                    <a href="{{ route('customers.create') }}" style="color:#3b82f6; display:block; margin-top:8px;">Add your first customer</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($customers->hasPages())
    <div style="padding:16px 24px; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
        <p style="font-size:13px; color:#94a3b8;">
            Showing {{ $customers->firstItem() }} – {{ $customers->lastItem() }} of {{ $customers->total() }} customers
        </p>
        {{ $customers->links() }}
    </div>
    @endif
</div>
@endsection