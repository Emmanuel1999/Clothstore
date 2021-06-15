<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'LGA' => 'required',
        'state' => 'required',
        'phone_number' => 'required',
    ];

    public function orders()
    {
        return $this->belongsTo('App/Models/Orders', 'orders_id');
    }

    public function product()
    {
        return $this->belongsTo('App/Models/Product', 'products_id');
    }

    
}
