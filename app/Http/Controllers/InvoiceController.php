<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
            'total_amount' => 0,
            'paid_amount' => 0,
            'due_amount' => 0,
        ]);

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product->selling_price,
                'total_price' => $item['quantity'] * $product->selling_price,
            ]);
        }

        $invoice->calculateTotals();

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'items.product', 'payments']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $products = Product::all();
        $invoice->load('items');
        return view('invoices.edit', compact('invoice', 'customers', 'products'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Delete existing items
        $invoice->items()->delete();

        // Create new items
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product->selling_price,
                'total_price' => $item['quantity'] * $product->selling_price,
            ]);
        }

        $invoice->update([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
        ]);

        $invoice->calculateTotals();

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }

    public function print(Invoice $invoice)
    {
        $invoice->load(['customer', 'items.product']);
        return view('invoices.print', compact('invoice'));
    }

    public function addPayment(Request $request, Invoice $invoice)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:'.$invoice->due_amount,
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
        ]);

        $payment = $invoice->payments()->create([
            'customer_id' => $invoice->customer_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        $invoice->calculateTotals();

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Payment added successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $invoices = Invoice::when($query, function ($q) use ($query) {
            $q->where('id', 'like', '%' . $query . '%');
        })->paginate(10);

        return view('invoices.table', compact('invoices'))->render();
    }
}