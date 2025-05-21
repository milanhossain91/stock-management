
@extends('layouts.app')

@section('title', 'Edit Vendor')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Vendor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $vendor->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $vendor->contact_person }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $vendor->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $vendor->phone }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3">{{ $vendor->address }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection