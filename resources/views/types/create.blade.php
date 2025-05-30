
@extends('layouts.app')

@section('title', 'Create Type')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Type</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('types.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection