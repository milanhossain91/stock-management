@extends('layouts.app')

@section('title', 'Create Invoice')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select class="form-select" id="customer_id" name="customer_id" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="invoice_date" class="form-label">Invoice Date</label>
                    <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered" id="itemsTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Pack Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-select product-select" name="items[0][product_id]" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                            data-pack-size="{{ $product->pack_size }}"
                                            data-price="{{ $product->selling_price }}">
                                            {{ $product->name }}-{{ $product->pack_size }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="pack-size"></td>
                            <td class="price"></td>
                            <td>
                                <input type="number" class="form-control quantity" name="items[0][quantity]" min="1" value="1" required>
                            </td>
                            <td class="total"></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-end">
                                <button type="button" class="btn btn-primary" id="addRow">
                                    <i class="bi bi-plus-lg"></i> Add Item
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Subtotal:</th>
                                <td id="subtotal">0.00</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Invoice</button>
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowCount = 1;
        
        // Add new row
        document.getElementById('addRow').addEventListener('click', function() {
            const newRow = document.querySelector('#itemsTable tbody tr').cloneNode(true);
            const newIndex = rowCount++;
            
            // Update names and IDs
            newRow.querySelector('.product-select').name = `items[${newIndex}][product_id]`;
            newRow.querySelector('.quantity').name = `items[${newIndex}][quantity]`;
            
            // Clear values
            newRow.querySelector('.product-select').selectedIndex = 0;
            newRow.querySelector('.quantity').value = 1;
            newRow.querySelector('.pack-size').textContent = '';
            newRow.querySelector('.price').textContent = '';
            newRow.querySelector('.total').textContent = '';
            
            // Add to table
            document.querySelector('#itemsTable tbody').appendChild(newRow);
            
            // Add event listeners to new row
            addRowEventListeners(newRow);
        });
        
        // Remove row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const row = e.target.closest('tr');
                if (document.querySelectorAll('#itemsTable tbody tr').length > 1) {
                    row.remove();
                    calculateTotal();
                } else {
                    alert('You must have at least one item.');
                }
            }
        });
        
        // Add event listeners to initial row
        addRowEventListeners(document.querySelector('#itemsTable tbody tr'));
        
        function addRowEventListeners(row) {
            // Product select change
            row.querySelector('.product-select').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const packSize = selectedOption.getAttribute('data-pack-size');
                const price = selectedOption.getAttribute('data-price');
                
                row.querySelector('.pack-size').textContent = packSize;
                row.querySelector('.price').textContent = parseFloat(price).toFixed(2);
                
                calculateRowTotal(row);
                calculateTotal();
            });
            
            // Quantity change
            row.querySelector('.quantity').addEventListener('input', function() {
                calculateRowTotal(row);
                calculateTotal();
            });
        }
        
        function calculateRowTotal(row) {
            const price = parseFloat(row.querySelector('.price').textContent) || 0;
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const total = price * quantity;
            
            row.querySelector('.total').textContent = total.toFixed(2);
        }
        
        function calculateTotal() {
            let subtotal = 0;
            
            document.querySelectorAll('#itemsTable tbody tr').forEach(row => {
                const total = parseFloat(row.querySelector('.total').textContent) || 0;
                subtotal += total;
            });
            
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
        }
    });
</script>
@endsection