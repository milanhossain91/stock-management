<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'pack_size',
        'buying_price',
        'selling_price',
        'quantity'
    ];

    protected $casts = [
        'buying_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // Helper method to update stock
    public function updateStock($quantity)
    {
        $this->quantity += $quantity;
        $this->save();
    }
}