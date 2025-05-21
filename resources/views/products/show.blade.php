@extends('layouts.app')

@section('title', 'View Product')

@section('actions')
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
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
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Pack Size</th>
                        <td>{{ $product->pack_size }}</td>
                    </tr>
                    <tr>
                        <th>Buying Price</th>
                        <td>{{ number_format($product->buying_price, 2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Selling Price</th>
                        <td>{{ number_format($product->selling_price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Current Stock</th>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $product->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection