<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
         return $this->belongsTo('App/Models/Category', 'category_id');
    }   

    public function orders(){
                
        return $this->hasMany('App/Models/Orders', 'order_id');
    }

    public function admin()
    {
        return $this->belongsTo('App/Models/Admin', 'admins_id');
    }

    public function user()
    {
        return $this->belongsTo('App/Models/User', 'user_id');
    }
    
}
