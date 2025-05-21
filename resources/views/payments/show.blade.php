@extends('layouts.app')

@section('title', 'Payment #' . $payment->id)

@section('actions')
    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">
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
                        <th>Payment #</th>
                        <td>{{ $payment->id }}</td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td>{{ $payment->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $payment->payment_date->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Amount</th>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Method</th>
                        <td>{{ $payment->payment_method }}</td>
                    </tr>
                    <tr>
                        <th>Invoice</th>
                        <td>
                            @if($payment->invoice_id)
                                <a href="{{ route('invoices.show', $payment->invoice_id) }}">#{{ $payment->invoice_id }}</a>
                            @else
                                General Payment
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            @if($payment->notes)
            <div class="col-12 mt-3">
                <h5>Notes</h5>
                <p>{{ $payment->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection