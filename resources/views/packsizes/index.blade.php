
@extends('layouts.app')

@section('title', 'Pack Sizes')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pack Size List</h5>
            <a href="{{ route('packsizes.create') }}" class="btn btn-primary">Add Pack Size</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Unit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packsizes as $packsize)
                            <tr>
                                <td>{{ $packsize->id }}</td>
                                <td>{{ $packsize->name }}</td>
                                <td>{{ $packsize->size }}</td>
                                <td>{{ $packsize->unit }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('packsizes.show', $packsize->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('packsizes.edit', $packsize->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('packsizes.destroy', $packsize->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No pack sizes found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection