
@extends('layouts.app')

@section('title', 'Create Pack Size')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Pack Size</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('packsizes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="text" class="form-control" id="size" name="size" required>
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('packsizes.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection