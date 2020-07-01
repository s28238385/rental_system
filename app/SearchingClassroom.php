<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchingClassroom extends Model
{
    protected $fillable = ['classroomName', 'imagePath', 'equipmentDescription'];
}
