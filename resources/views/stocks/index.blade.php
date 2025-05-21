<!-- resources/views/stocks/index.blade.php -->
@extends('layouts.app')

@section('title', 'Stock')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Stock List</h5>
            <a href="{{ route('stocks.create') }}" class="btn btn-primary">Add Stock</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vendor</th>
                            <th>Type</th>
                            <th>Product</th>
                            <th>Pack Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $stock)
                            <tr>
                                <td>{{ $stock->id }}</td>
                                <td>{{ $stock->vendor->name }}</td>
                                <td>{{ $stock->type->name }}</td>
                                <td>{{ $stock->product->name }}</td>
                                <td>{{ $stock->packsizes->name }} ({{ $stock->packsizes->size }}{{ $stock->packsizes->unit }})</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ number_format($stock->price, 2) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No stock items found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection