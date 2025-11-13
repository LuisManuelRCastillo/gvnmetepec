<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
     use SoftDeletes;
     protected $table = 'products';

    
    protected $fillable = [
        'code', 'category_id', 'name', 'size', 'stock', 'min_stock',
        'cost_price', 'estimated_price', 'sale_price', 'description',
        'image', 'active'
    ];
    
    protected $casts = [
        'cost_price' => 'decimal:2',
        'estimated_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'active' => 'boolean',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
    
    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
    
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
    
    // Método para verificar stock bajo
    public function isLowStock()
    {
        return $this->stock <= $this->min_stock;
    }
    
    // Método para calcular margen de ganancia
    public function getProfitMargin()
    {
        if ($this->cost_price == 0) return 0;
        return (($this->sale_price - $this->cost_price) / $this->cost_price) * 100;
    }
}
