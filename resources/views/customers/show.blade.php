@extends('layouts.app')

@section('title', 'View Customer')

@section('actions')
    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil"></i> Edit
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{ $customer->mobile }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Total Due</th>
                        <td class="{{ $customer->total_due > 0 ? 'text-danger' : 'text-success' }}">
                            {{ number_format($customer->total_due, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $customer->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $customer->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 mt-3">
                <h5>Address</h5>
                <p>{{ $customer->address }}</p>
            </div>
        </div>

        <ul class="nav nav-tabs mt-4" id="customerTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="invoices-tab" data-bs-toggle="tab" data-bs-target="#invoices" type="button" role="tab">
                    Invoices ({{ $customer->invoices->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab">
                    Payments ({{ $customer->payments->count() }})
                </button>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="customerTabsContent">
            <div class="tab-pane fade show active" id="invoices" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->invoices as $invoice)
                            <tr>
                                <td><a href="{{ route('invoices.show', $invoice->id) }}">#{{ $invoice->id }}</a></td>
                                <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }}</td>
                                <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                                <td class="{{ $invoice->due_amount > 0 ? 'text-danger' : 'text-success' }}">
                                    {{ number_format($invoice->due_amount, 2) }}
                                </td>
                                <td>
                                    <a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="payments" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Payment #</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->payments as $payment)
                            <tr>
                                <td><a href="{{ route('payments.show', $payment->id) }}">#{{ $payment->id }}</a></td>
                                <td>{{ $payment->payment_date->format('d M Y') }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>
                                    @if($payment->invoice_id)
                                        <a href="{{ route('invoices.show', $payment->invoice_id) }}">#{{ $payment->invoice_id }}</a>
                                    @else
                                        General Payment
                                    @endif
                                </td>
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

@section('scripts')
<script>
    // Activate Bootstrap tabs
    const tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabElms.forEach(tabElm => {
        tabElm.addEventListener('click', event => {
            event.preventDefault();
            const tab = new bootstrap.Tab(event.target);
            tab.show();
        });
    });
</script>
@endsection