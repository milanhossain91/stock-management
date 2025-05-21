<!-- resources/views/vendors/index.blade.php -->
@extends('layouts.app')

@section('title', 'Vendors')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Vendor List</h5>
            <a href="{{ route('vendors.create') }}" class="btn btn-primary">Add Vendor</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->id }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->contact_person ?? 'N/A' }}</td>
                                <td>{{ $vendor->email ?? 'N/A' }}</td>
                                <td>{{ $vendor->phone ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No vendors found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection