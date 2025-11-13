<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    //
     protected $fillable = [
        'sale_id', 'product_id', 'product_code', 'product_name',
        'quantity', 'unit_price', 'subtotal', 'discount', 'total'
    ];
    
    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];
    
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
