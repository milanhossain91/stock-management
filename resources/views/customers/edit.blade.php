@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $customer->mobile }}" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ $customer->address }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection