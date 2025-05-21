<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{

    // Update the customerReport method
    public function customerReport(Request $request)
    {
        $fromDate = $request->input('from_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $toDate = $request->input('to_date', Carbon::now()->format('Y-m-d'));

        $customers = Customer::with(['invoices' => function($query) use ($fromDate, $toDate) {
            $query->whereBetween('invoice_date', [$fromDate, $toDate])
                ->with('items.product');
        }])->get();

        // Calculate summary for each customer
        $customers->each(function($customer) {
            $customer->total_sales = $customer->invoices->sum('total_amount');
            $customer->total_paid = $customer->invoices->sum('paid_amount');
            $customer->total_due = $customer->invoices->sum('due_amount');
            $customer->total_items = $customer->invoices->flatMap->items->sum('quantity');
        });

        if ($request->has('export') && $request->export == 'pdf') {
            $pdf = PDF::loadView('reports.pdf.customer', compact('customers', 'fromDate', 'toDate'));
            return $pdf->download('customer-sales-report-'.now()->format('Y-m-d').'.pdf');
        }

        return view('reports.customer', compact('customers', 'fromDate', 'toDate'));
    }

    // Update the productReport method
    public function productReport(Request $request)
    {
        $fromDate = $request->input('from_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $toDate = $request->input('to_date', Carbon::now()->format('Y-m-d'));

        $products = Product::with(['invoiceItems' => function($query) use ($fromDate, $toDate) {
            $query->whereHas('invoice', function($q) use ($fromDate, $toDate) {
                $q->whereBetween('invoice_date', [$fromDate, $toDate]);
            });
        }])->get();

        // Calculate summary for each product
        $products->each(function($product) {
            $product->total_sold = $product->invoiceItems->sum('quantity');
            $product->total_amount = $product->invoiceItems->sum('total_price');
        });

        if ($request->has('export') && $request->export == 'pdf') {
            $pdf = PDF::loadView('reports.pdf.product', compact('products', 'fromDate', 'toDate'));
            return $pdf->download('product-sales-report-'.now()->format('Y-m-d').'.pdf');
        }

        return view('reports.product', compact('products', 'fromDate', 'toDate'));
    }
}
