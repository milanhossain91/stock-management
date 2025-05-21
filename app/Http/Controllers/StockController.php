<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Vendor;
use App\Models\Type;
use App\Models\Product;
use App\Models\Packsizes;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with(['vendor', 'type', 'product', 'packsizes'])->get();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        $types = Type::all();
        $products = Product::all();
        $packsizes = Packsizes::all();
        
        return view('stocks.create', compact('vendors', 'types', 'products', 'packsizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'type_id' => 'required|exists:types,id',
            'product_id' => 'required|exists:products,id',
            'packsizes_id' => 'required|exists:packsizes,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if this combination already exists
        $existingStock = Stock::where('vendor_id', $request->vendor_id)
            ->where('type_id', $request->type_id)
            ->where('product_id', $request->product_id)
            ->where('packsizes_id', $request->packsizes_id)
            ->first();

        if ($existingStock) {
            return back()->with('error', 'This stock item already exists. Please update the existing entry instead.');
        }

        Stock::create($request->all());

        return redirect()->route('stocks.index')
            ->with('success', 'Stock created successfully.');
    }

    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        $vendors = Vendor::all();
        $types = Type::all();
        $products = Product::all();
        $packsizes = Packsizes::all();
        
        return view('stocks.edit', compact('stock', 'vendors', 'types', 'products', 'packsizes'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'type_id' => 'required|exists:types,id',
            'product_id' => 'required|exists:products,id',
            'packsizes_id' => 'required|exists:packsizes,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')
            ->with('success', 'Stock updated successfully');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')
            ->with('success', 'Stock deleted successfully');
    }
}