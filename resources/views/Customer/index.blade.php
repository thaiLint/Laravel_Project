@extends('layouts.app')
@section('title', 'Customer Management')

@push('styles')
<style>
    .table thead { background-color: #1a73e8; color: white; }
    .table thead th { font-weight: 500; border: none; padding: 14px 16px; }
    .table tbody tr { background: #fff; }
    .table tbody td { vertical-align: middle; padding: 14px 16px; }
    .badge-active   { background-color: #28a745; }
    .badge-inactive { background-color: #dc3545; }
    .btn-add { background-color: #1a73e8; color: #fff; border-radius: 8px; font-weight: 500; }
    .btn-add:hover { background-color: #155cb5; color: #fff; }
    .search-input { border-radius: 8px; border: 1px solid #cdd5e0; width: 280px; }
    .page-title { font-weight: 800; font-size: 1.8rem; }
    .customer-avatar {
        width: 48px; height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }
    .avatar-placeholder {
        width: 48px; height: 48px;
        border-radius: 50%;
        background: #e8f0fe;
        color: #1a73e8;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 1.1rem;
    }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Customer Management</h2>
            <div class="d-flex gap-3 align-items-center">
                <input type="text" class="form-control search-input" id="searchInput" placeholder="Search customer...">
                <a href="{{ route('customers.create') }}" class="btn btn-add px-4">
                    <i class="bi bi-plus-lg me-1"></i> Add Customer
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-borderless rounded overflow-hidden" id="customerTable">
                <thead>
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
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>
    @if($customer->photo)
        <img src="{{ asset('uploads/customer/' . $customer->photo) }}"
             class="customer-avatar"
             alt="{{ $customer->name }}">
    @else
        <div class="avatar-placeholder">
            {{ strtoupper(substr($customer->name, 0, 1)) }}
        </div>
    @endif
</td>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->room ?? 'N/A' }}</td>
                        <td>
                            @if($customer->status === 'Active')
                                <span class="badge badge-active rounded-pill px-3 py-2">Active</span>
                            @else
                                <span class="badge badge-inactive rounded-pill px-3 py-2">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm px-3">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Delete this customer?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No customers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $customers->links() }}
        </div>

    </div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const val = this.value.toLowerCase();
        document.querySelectorAll('#customerTable tbody tr').forEach(r => {
            r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush