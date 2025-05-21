
@extends('layouts.app')

@section('title', 'Types')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Type List</h5>
            <a href="{{ route('types.create') }}" class="btn btn-primary">Add Type</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($types as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ Str::limit($type->description, 50) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('types.show', $type->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('types.edit', $type->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No types found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection