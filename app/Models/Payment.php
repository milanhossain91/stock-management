<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_id',
        'amount',
        'payment_date',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function booted()
    {
        static::created(function ($payment) {
            if ($payment->invoice_id) {
                $payment->invoice->calculateTotals();
            } else {
                $payment->customer->updateDue(-$payment->amount);
            }
        });

        static::updated(function ($payment) {
            if ($payment->invoice_id) {
                $payment->invoice->calculateTotals();
            } else {
                $payment->customer->updateDue(-$payment->amount);
            }
        });

        static::deleted(function ($payment) {
            if ($payment->invoice_id) {
                $payment->invoice->calculateTotals();
            } else {
                $payment->customer->updateDue($payment->amount);
            }
        });
    }
}
