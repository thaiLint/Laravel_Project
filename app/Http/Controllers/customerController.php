<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
    $customers = Customer::paginate(10);

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required',
    'email' => 'required|email|unique:customers',
    'phone' => 'required',
    'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
]);

        $photoName = null;

        if ($request->hasFile('photo')) {

            $photoName = time() . '.' .
                $request->photo->extension();

           $request->photo->move(public_path('uploads/customer'), $photoName);
            
        }

        Customer::create([
        'name' => $request->name,   
        'photo' => $photoName,
        'email' => $request->email,
        'phone' => $request->phone,
        'room' => $request->room,
        'status' => $request->status,
    ]);

    

        return redirect()
    ->route('customers.index')
    ->with('success', 'Customer added successfully');
    }
    public function edit($id)
{
    $customer = Customer::findOrFail($id);

    return view('customer.edit', compact('customer'));
}
public function update(Request $request, $id)
{
    $customer = Customer::findOrFail($id);

    $photoName = $customer->photo;

    if ($request->hasFile('photo')) {

        $photoName = time() . '.' .
            $request->photo->extension();

        $request->photo->move(
            public_path('uploads/customer'),
            $photoName
        );
    }

    $customer->update([
        'name' => $request->name,
        'photo' => $photoName,
        'email' => $request->email,
        'phone' => $request->phone,
        'room' => $request->room,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer updated successfully');
}
public function destroy($id)
{
    $customer = Customer::findOrFail($id);
    $customer->delete();

    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer deleted successfully');
}
}