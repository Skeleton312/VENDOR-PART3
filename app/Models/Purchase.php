<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Purchase.php
class Purchase extends Model
{
    protected $primaryKey = 'purchase_id';
    
    protected $fillable = [
        'vendor_id',
        'user_id',
        'project_id',
        'total_amount',
        'purchase_date',
        'status'
    ];
}

class PurchaseDetail extends Model
{
    protected $primaryKey = 'purchase_detail_id';
    
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'subtotal',
        'updated_at'
    ];
}