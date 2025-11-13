<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = [
        'invoice_number', 'supplier_id', 'user_id', 'subtotal',
        'tax', 'total', 'status', 'notes', 'purchase_date'
    ];
    
    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'purchase_date' => 'datetime',
    ];
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
