<table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Total Due</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($customers as $customer)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->mobile }}</td>
                <td>{{ Str::limit($customer->address, 30) }}</td>
                <td class="{{ $customer->total_due > 0 ? 'text-danger' : 'text-success' }}">
                    {{ number_format($customer->total_due, 2) }}
                </td>
                <td>
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $customers->links('vendor.pagination.bootstrap-4') }}
    </div>