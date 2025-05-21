<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::creating(function ($item) {
            $item->total_price = $item->quantity * $item->unit_price;
        });

        static::created(function ($item) {
            // Update product stock
            $item->product->updateStock(-$item->quantity);
            // Update invoice totals
            $item->invoice->calculateTotals();
        });

        static::updated(function ($item) {
            $item->total_price = $item->quantity * $item->unit_price;
            $item->save();
            $item->invoice->calculateTotals();
        });

        static::deleted(function ($item) {
            // Restore product stock
            $item->product->updateStock($item->quantity);
            // Update invoice totals
            $item->invoice->calculateTotals();
        });
    }
}