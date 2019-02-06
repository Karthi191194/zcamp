<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
        //gallery
    protected $table = 'galleries';
    protected $fillable = ['image', 'thumbnail', 'title', 'status'];
}
