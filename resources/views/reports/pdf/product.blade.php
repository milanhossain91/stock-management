<!DOCTYPE html>
<html>
<head>
    <title>Product Sales Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .table-active { background-color: rgba(0,0,0,.075); }
        .report-header { text-align: center; margin-bottom: 20px; }
        .report-title { font-size: 18px; font-weight: bold; }
        .report-period { font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="report-header">
        <div class="report-title">Product Sales Report</div>
        <div class="report-period">
            From {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }} 
            to {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Pack Size</th>
                <th>Current Stock</th>
                <th>Total Sold</th>
                <th>Total Amount</th>
                <th>Avg. Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            @if($product->invoiceItems->count() > 0)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pack_size }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->total_sold }}</td>
                <td class="text-right">{{ number_format($product->total_amount, 2) }}</td>
                <td class="text-right">
                    @if($product->total_sold > 0)
                        {{ number_format($product->total_amount / $product->total_sold, 2) }}
                    @else
                        0.00
                    @endif
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-active">
                <th colspan="3">Total</th>
                <th>{{ $products->sum('total_sold') }}</th>
                <th class="text-right">{{ number_format($products->sum('total_amount'), 2) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>