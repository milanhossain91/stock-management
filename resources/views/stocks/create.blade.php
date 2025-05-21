<!-- resources/views/stocks/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Stock')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Stock</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vendor_id" class="form-label">Vendor</label>
                        <select class="form-select" id="vendor_id" name="vendor_id" required>
                            <option value="">Select Vendor</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <select class="form-select" id="type_id" name="type_id" required>
                            <option value="">Select Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="product_id" class="form-label">Product</label>
                        <select class="form-select" id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="packsizes_id" class="form-label">Pack Size</label>
                        <select class="form-select" id="packsizes_id" name="packsizes_id" required>
                            <option value="">Select Pack Size</option>
                            @foreach($packsizes as $packsize)
                                <option value="{{ $packsize->id }}">{{ $packsize->name }} ({{ $packsize->size }}{{ $packsize->unit }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" min="0" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection