
@extends('layouts.app')

@section('title', 'Product Sales Report')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Product Sales Report</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reports.product') }}" class="mb-4">
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
                    <a href="{{ route('reports.product') }}" class="btn btn-secondary ms-2">Reset</a>
                </div>
                <div class="col-md-3 d-flex align-items-end justify-content-end">
                    <a href="{{ route('reports.product', ['from_date' => $fromDate, 'to_date' => $toDate, 'export' => 'pdf']) }}" 
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
                        <th>Product</th>
                        <th>Pack Size</th>
                        <th>Current Stock</th>
                        <th>Total Sold</th>
                        <th>Total Amount</th>
                        <th>Avg. Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    @if($product->invoiceItems->count() > 0)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pack_size }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->total_sold }}</td>
                        <td>{{ number_format($product->total_amount, 2) }}</td>
                        <td>
                            @if($product->total_sold > 0)
                                {{ number_format($product->total_amount / $product->total_sold, 2) }}
                            @else
                                0.00
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">
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
                        <th>{{ $products->sum('total_sold') }}</th>
                        <th>{{ number_format($products->sum('total_amount'), 2) }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection