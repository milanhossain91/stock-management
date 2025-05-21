
@extends('layouts.app')

@section('title', 'Type Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Type Details</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6>Name:</h6>
                    <p>{{ $type->name }}</p>
                </div>
            </div>
            <div class="mb-3">
                <h6>Description:</h6>
                <p>{{ $type->description ?? 'N/A' }}</p>
            </div>
            <div class="mb-3">
                <h6>Created At:</h6>
                <p>{{ $type->created_at->format('M d, Y H:i A') }}</p>
            </div>
            <div class="mb-3">
                <h6>Updated At:</h6>
                <p>{{ $type->updated_at->format('M d, Y H:i A') }}</p>
            </div>
            <a href="{{ route('types.edit', $type->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('types.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection