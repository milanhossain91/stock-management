<!DOCTYPE html>
<html>
<head>
    <title>Customer Sales Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-danger { color: #dc3545; }
        .text-success { color: #28a745; }
        .table-active { background-color: rgba(0,0,0,.075); }
        .report-header { text-align: center; margin-bottom: 20px; }
        .report-title { font-size: 18px; font-weight: bold; }
        .report-period { font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="report-header">
        <div class="report-title">Customer Sales Report</div>
        <div class="report-period">
            From {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }} 
            to {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Mobile</th>
                <th>Total Invoices</th>
                <th>Total Items</th>
                <th>Total Sales</th>
                <th>Total Paid</th>
                <th>Total Due</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            @if($customer->invoices->count() > 0)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->mobile }}</td>
                <td>{{ $customer->invoices->count() }}</td>
                <td>{{ $customer->total_items }}</td>
                <td class="text-right">{{ number_format($customer->total_sales, 2) }}</td>
                <td class="text-right">{{ number_format($customer->total_paid, 2) }}</td>
                <td class="text-right {{ $customer->total_due > 0 ? 'text-danger' : 'text-success' }}">
                    {{ number_format($customer->total_due, 2) }}
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-active">
                <th colspan="3">Total</th>
                <th>{{ $customers->sum('total_items') }}</th>
                <th class="text-right">{{ number_format($customers->sum('total_sales'), 2) }}</th>
                <th class="text-right">{{ number_format($customers->sum('total_paid'), 2) }}</th>
                <th class="text-right">{{ number_format($customers->sum('total_due'), 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>