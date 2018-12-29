<?php

namespace App\eapi_model;

use App\eapi_model\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //eapi
    public function Products(){
        return $this->belongsTo(Product::class);
    }

    public function rel_products(){
        //Reviews table belongs to Products table - we added products primary id as foreign key here.
        //One To One
        return $this->belongsTo('App\eapi_model\Product','product_id', 'id');
    }
}
