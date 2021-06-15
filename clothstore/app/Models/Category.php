<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {

        return $this->hasMany('App/Models/category', 'category_id');
    }
    
    public function admin()
    {
        return $this->belongsTo('App/Models/Admin', 'admins_id');
    }
}

