@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Products</h5>
                <p class="card-text display-6">{{ App\Models\Product::count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Customers</h5>
                <p class="card-text display-6">{{ App\Models\Customer::count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Today's Invoices</h5>
                <p class="card-text display-6">{{ App\Models\Invoice::whereDate('invoice_date', today())->count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Total Due</h5>
                <p class="card-text display-6">{{ number_format(App\Models\Customer::sum('total_due'), 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Recent Invoices
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Invoice::with('customer')->latest()->take(5)->get() as $invoice)
                            <tr>
                                <td><a href="{{ route('invoices.show', $invoice->id) }}">#{{ $invoice->id }}</a></td>
                                <td>{{ $invoice->customer->name }}</td>
                                <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Recent Payments
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Payment #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Payment::with('customer')->latest()->take(5)->get() as $payment)
                            <tr>
                                <td><a href="{{ route('payments.show', $payment->id) }}">#{{ $payment->id }}</a></td>
                                <td>{{ $payment->customer->name }}</td>
                                <td>{{ $payment->payment_date->format('d M Y') }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
