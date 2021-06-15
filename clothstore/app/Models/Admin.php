<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
     protected $fillable = [
          'name' => 'required',
          'contact' => 'required',
          'email' => 'required',
          'password' => 'required',
     ];

     public function products()
     {
          return $this->hasMany('App/Models/Product', 'products_id');
     }

     public function categories()
     {
          return $this->hasMany('App/Models/Category', 'categories_id');

     }

     
}
