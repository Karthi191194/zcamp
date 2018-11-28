<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //tasks
    protected $fillable = ['task_name', 'task_description'];
}
