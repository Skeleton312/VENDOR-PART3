<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $primaryKey = 'sale_id';
    
    protected $fillable = [
        'customer_id',
        'fixed_amount',
        'sale_date',
        'status'
    ];

    protected $casts = [
        'sale_date' => 'date',
        'fixed_amount' => 'decimal:2'
    ];

    public function details()
    {
        return $this->hasMany(SalesDetail::class, 'sale_id', 'sale_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}