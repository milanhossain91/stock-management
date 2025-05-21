
@extends('layouts.app')

@section('title', 'Vendor Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Vendor Details</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Name:</h6>
                    <p>{{ $vendor->name }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Contact Person:</h6>
                    <p>{{ $vendor->contact_person ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Email:</h6>
                    <p>{{ $vendor->email ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Phone:</h6>
                    <p>{{ $vendor->phone ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="mb-3">
                <h6>Address:</h6>
                <p>{{ $vendor->address ?? 'N/A' }}</p>
            </div>
            <div class="mb-3">
                <h6>Created At:</h6>
                <p>{{ $vendor->created_at->format('M d, Y H:i A') }}</p>
            </div>
            <div class="mb-3">
                <h6>Updated At:</h6>
                <p>{{ $vendor->updated_at->format('M d, Y H:i A') }}</p>
            </div>
            <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection