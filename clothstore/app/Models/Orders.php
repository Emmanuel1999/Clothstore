<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'quantity' => 'required',
        'products_id' => 'required',
        'status' => 'required',
        'total' => 'required',
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
        'LGA' => 'required',
        'state' => 'required',
        'phone_number' => 'required',
        'users_id' => 'required',
    ];


    public function product()
    {
        return $this->belongsTo('App/Models/Product', 'products_id');
    }
    
    public function user()
    {
        return $this->hasMany('App/Models/User', 'user_id');
    }
}




