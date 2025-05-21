
@extends('layouts.app')

@section('title', 'Pack Size Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Pack Size Details</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <h6>Name:</h6>
                    <p>{{ $packsizes->name }}</p>
                </div>
                <div class="col-md-4">
                    <h6>Size:</h6>
                    <p>{{ $packsizes->size }}</p>
                </div>
                <div class="col-md-4">
                    <h6>Unit:</h6>
                    <p>{{ $packsizes->unit }}</p>
                </div>
            </div>
            <div class="mb-3">
                <h6>Created At:</h6>
                <p>{{ $packsizes->created_at->format('M d, Y H:i A') }}</p>
            </div>
            <div class="mb-3">
                <h6>Updated At:</h6>
                <p>{{ $packsizes->updated_at->format('M d, Y H:i A') }}</p>
            </div>
            <a href="{{ route('packsizes.edit', $packsizes->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('packsizes.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection