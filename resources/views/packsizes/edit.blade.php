
@extends('layouts.app')

@section('title', 'Edit Pack Size')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Pack Size</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('packsizes.update', $packsizes->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $packsizes->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" class="form-control" id="size" name="size" value="{{ $packsizes->size }}" required>
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" value="{{ $packsizes->unit }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('packsizes.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection