
@extends('layouts.app')

@section('title', 'Customer Sales Report')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Customer Sales Report</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reports.customer') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{ $fromDate }}">
                </div>
                <div class="col-md-3">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{ $toDate }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('reports.customer') }}" class="btn btn-secondary ms-2">Reset</a>
                </div>
                <div class="col-md-3 d-flex align-items-end justify-content-end">
                    <a href="{{ route('reports.customer', ['from_date' => $fromDate, 'to_date' => $toDate, 'export' => 'pdf']) }}" 
                       class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Customer</th>
                        <th>Mobile</th>
                        <th>Total Invoices</th>
                        <th>Total Items</th>
                        <th>Total Sales</th>
                        <th>Total Paid</th>
                        <th>Total Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    @if($customer->invoices->count() > 0)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->invoices->count() }}</td>
                        <td>{{ $customer->total_items }}</td>
                        <td>{{ number_format($customer->total_sales, 2) }}</td>
                        <td>{{ number_format($customer->total_paid, 2) }}</td>
                        <td class="{{ $customer->total_due > 0 ? 'text-danger' : 'text-success' }}">
                            {{ number_format($customer->total_due, 2) }}
                        </td>
                        <td>
                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-active">
                        <th colspan="3">Total</th>
                        <th>{{ $customers->sum('total_items') }}</th>
                        <th>{{ number_format($customers->sum('total_sales'), 2) }}</th>
                        <th>{{ number_format($customers->sum('total_paid'), 2) }}</th>
                        <th>{{ number_format($customers->sum('total_due'), 2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection