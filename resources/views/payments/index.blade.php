@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Payment #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Invoice</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->customer->name }}</td>
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
                <td>
                    <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
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

{{ $payments->links() }}
@endsection