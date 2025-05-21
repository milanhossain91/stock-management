<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
            padding: 0;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-details, .customer-details {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            width: 200px;
            border-top: 1px solid #333;
            text-align: center;
            margin-top: 50px;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="no-print" style="margin-bottom: 20px; padding: 5px 15px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Print Invoice
    </button>

    <div class="invoice-header">
        <h1>INVOICE</h1>
        <p>Inventory Management System</p>
    </div>

    <div class="invoice-info">
        <div class="invoice-details">
            <p><strong>Invoice #:</strong> {{ $invoice->id }}</p>
            <p><strong>Date:</strong> {{ $invoice->invoice_date->format('d M Y') }}</p>
        </div>
        <div class="customer-details">
            <p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
            <p><strong>Mobile:</strong> {{ $invoice->customer->mobile }}</p>
            <p><strong>Address:</strong> {{ $invoice->customer->address }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Pack Size</th>
                <th>Price</th>
                <th>Qty</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->pack_size }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">Subtotal:</td>
                <td class="text-right">{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="5" class="text-right">Paid Amount:</td>
                <td class="text-right">{{ number_format($invoice->paid_amount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="5" class="text-right">Due Amount:</td>
                <td class="text-right">{{ number_format($invoice->due_amount, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    @if($invoice->notes)
    <div style="margin-bottom: 20px;">
        <p><strong>Notes:</strong> {{ $invoice->notes }}</p>
    </div>
    @endif

    <div class="footer">
        <div>
            <p>Thank you for your business!</p>
        </div>
        <div class="signature">
            <p>Authorized Signature</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>