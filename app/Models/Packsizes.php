<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packsizes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'size', 'unit'];

    public function stockItems()
    {
        return $this->hasMany(Stock::class);
    }
}