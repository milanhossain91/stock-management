@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pack_size" class="form-label">Pack Size</label>
                    <input type="text" class="form-control" id="pack_size" name="pack_size" value="{{ $product->pack_size }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="buying_price" class="form-label">Buying Price</label>
                    <input type="number" step="0.01" class="form-control" id="buying_price" name="buying_price" value="{{ $product->buying_price }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="selling_price" class="form-label">Selling Price</label>
                    <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection