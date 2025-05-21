<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 
        'type_id', 
        'product_id', 
        'packsizes_id', 
        'quantity', 
        'price'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function packsizes()
    {
        return $this->belongsTo(Packsizes::class);
    }
}