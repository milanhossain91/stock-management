@extends('layouts.app')

@section('title', 'Invoice #' . $invoice->id)

@section('actions')
    <a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-info" target="_blank">
        <i class="bi bi-printer"></i> Print
    </a>
    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil"></i> Edit
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Invoice Details</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Invoice #</th>
                        <td>{{ $invoice->id }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td>{{ $invoice->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{ $invoice->customer->mobile }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Amount Summary</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Total Amount</th>
                        <td>{{ number_format($invoice->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Paid Amount</th>
                        <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Due Amount</th>
                        <td class="{{ $invoice->due_amount > 0 ? 'text-danger' : 'text-success' }}">
                            {{ number_format($invoice->due_amount, 2) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Pack Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->pack_size }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Subtotal:</th>
                        <th>{{ number_format($invoice->total_amount, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($invoice->notes)
        <div class="mb-4">
            <h5>Notes</h5>
            <p>{{ $invoice->notes }}</p>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Payment History</h5>
            </div>
            <div class="card-body">
                @if($invoice->payments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Payment #</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->payments as $payment)
                            <tr>
                                <td><a href="{{ route('payments.show', $payment->id) }}">#{{ $payment->id }}</a></td>
                                <td>{{ $payment->payment_date->format('d M Y') }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>
                                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p>No payments recorded for this invoice.</p>
                @endif
            </div>
        </div>

        @if($invoice->due_amount > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5>Add Payment</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('invoices.add-payment', $invoice->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" 
                                   max="{{ $invoice->due_amount }}" value="{{ $invoice->due_amount }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="payment_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date" 
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="payment_method" class="form-label">Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="Cash">Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Check">Check</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <input type="text" class="form-control" id="notes" name="notes">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Record Payment</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection