<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'phone', 'rfc', 'address',
        'city', 'state', 'postal_code'
    ];
    
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
