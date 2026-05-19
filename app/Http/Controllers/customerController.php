<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $customers = $query->orderBy('id', 'desc')->paginate(10);

        
        $activeCount = Customer::where('status', 'active')->count();
        $inactiveCount = Customer::where('status', 'inactive')->count();
        $thisMonth = Customer::where('created_at', '>=', now()->startOfMonth())->count();

        return view('customer.index', compact(
            'customers',
            'activeCount',
            'inactiveCount',
            'thisMonth'
        ));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully');
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}