<table class="table table-hover">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td><a href="{{ route('invoices.show', $invoice->id) }}">#{{ $invoice->id }}</a></td>
                <td>{{ $invoice->customer->name }}</td>
                <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
                <td>{{ number_format($invoice->total_amount, 2) }}</td>
                <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                <td class="{{ $invoice->due_amount > 0 ? 'text-danger' : 'text-success' }}">
                    {{ number_format($invoice->due_amount, 2) }}
                </td>
                <td>
                    <a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-sm btn-info" target="_blank">
                        <i class="bi bi-printer"></i>
                    </a>
                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
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
        {{ $invoices->links('vendor.pagination.bootstrap-4') }}
    </div>