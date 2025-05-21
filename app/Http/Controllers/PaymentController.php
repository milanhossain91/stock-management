<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['customer', 'invoice'])->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create(Customer $customer)
    {
        $invoices = $customer->invoices()->where('due_amount', '>', 0)->get();
        return view('payments.create', compact('customer', 'invoices'));
    }

    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'invoice_id' => 'nullable|exists:invoices,id',
        ]);

        $payment = Payment::create([
            'customer_id' => $customer->id,
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        if ($request->invoice_id) {
            return redirect()->route('invoices.show', $request->invoice_id)
                ->with('success', 'Payment added successfully.');
        }

        return redirect()->route('customers.show', $customer->id)
            ->with('success', 'Payment added successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['customer', 'invoice']);
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $invoices = $payment->customer->invoices()->where('due_amount', '>', 0)->get();
        return view('payments.edit', compact('payment', 'invoices'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'invoice_id' => 'nullable|exists:invoices,id',
        ]);

        $payment->update([
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        if ($payment->invoice_id) {
            return redirect()->route('invoices.show', $payment->invoice_id)
                ->with('success', 'Payment updated successfully.');
        }

        return redirect()->route('customers.show', $payment->customer_id)
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $customer_id = $payment->customer_id;
        $invoice_id = $payment->invoice_id;
        
        $payment->delete();

        if ($invoice_id) {
            return redirect()->route('invoices.show', $invoice_id)
                ->with('success', 'Payment deleted successfully.');
        }

        return redirect()->route('customers.show', $customer_id)
            ->with('success', 'Payment deleted successfully.');
    }
}