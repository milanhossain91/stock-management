<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Pack Size</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($products as $product)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pack_size }}</td>
            <td>{{ number_format($product->buying_price, 2) }}</td>
            <td>{{ number_format($product->selling_price, 2) }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
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
    {{ $products->links('vendor.pagination.bootstrap-4') }}
</div>
