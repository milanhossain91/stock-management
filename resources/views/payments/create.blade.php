@extends('layouts.app')

@section('title', 'Add Payment for ' . $customer->name)

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('payments.store', $customer->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="payment_date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="payment_method" class="form-label">Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Check">Check</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="invoice_id" class="form-label">Invoice (Optional)</label>
                    <select class="form-select" id="invoice_id" name="invoice_id">
                        <option value="">General Payment</option>
                        @foreach($invoices as $invoice)
                            <option value="{{ $invoice->id }}" data-due="{{ $invoice->due_amount }}">
                                Invoice #{{ $invoice->id }} (Due: {{ number_format($invoice->due_amount, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Record Payment</button>
            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const invoiceSelect = document.getElementById('invoice_id');
        const amountInput = document.getElementById('amount');
        
        invoiceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const dueAmount = selectedOption.getAttribute('data-due');
            
            if (dueAmount) {
                amountInput.max = dueAmount;
                amountInput.value = dueAmount;
            } else {
                amountInput.removeAttribute('max');
            }
        });
    });
</script>
@endsection
@endsection