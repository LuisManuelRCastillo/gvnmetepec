<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
     protected $fillable = [
        'name', 'contact_name', 'email', 'phone', 'address', 'active'
    ];
    
    protected $casts = [
        'active' => 'boolean',
    ];
    
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
