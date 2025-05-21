<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'mobile',
        'total_due'
    ];

    protected $casts = [
        'total_due' => 'decimal:2',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helper method to update customer's due amount
    public function updateDue($amount)
    {
        $this->total_due += $amount;
        $this->save();
    }
}
