<?php

namespace App\eapi_model;

use App\eapi_model\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //eapi
    public function reviews(){
        //Products table has many reviews
        //One To Many
        return $this->hasMany(Review::class);
    }

    public function rel_reviews(){
        //Products table has one relationship with reviews table.
        //Product table is the main  table, reviews is the second table. So here hasOne method used.
        //One To One
        return $this->hasOne('Review','product_id', 'id');
    }
}
