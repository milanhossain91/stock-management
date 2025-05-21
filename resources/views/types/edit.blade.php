
@extends('layouts.app')

@section('title', 'Edit Type')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Type</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('types.update', $type->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $type->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $type->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('types.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection