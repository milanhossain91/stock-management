<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile' => 'required|string|max:20',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile' => 'required|string|max:20',
        ]);

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

    public function invoices(Customer $customer)
    {
        $invoices = $customer->invoices()->latest()->paginate(10);
        return view('customers.invoices', compact('customer', 'invoices'));
    }

    public function payments(Customer $customer)
    {
        $payments = $customer->payments()->latest()->paginate(10);
        return view('customers.payments', compact('customer', 'payments'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $customers = Customer::when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->paginate(10);

        return view('customers.table', compact('customers'))->render();
    }
}