<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_date',
        'total_amount',
        'paid_amount',
        'due_amount',
        'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'invoice_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helper method to calculate invoice totals
    public function calculateTotals()
    {
        $total = $this->items->sum('total_price');
        $paid = $this->payments->sum('amount');
        
        $this->total_amount = $total;
        $this->paid_amount = $paid;
        $this->due_amount = $total - $paid;
        $this->save();
        
        // Update customer's total due
        $this->customer->updateDue($this->due_amount - $this->customer->total_due);
    }
}