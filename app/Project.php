<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //new project - insert form 4

    protected $fillable = ['project_name', 'project_members', '	project_credentials'];
}
