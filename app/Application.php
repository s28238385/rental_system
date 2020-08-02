<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name', 'identity', 'certificate', 'phone', 'classroom', 'key_type', 'teacher', 'return_time', 'all_status', 'key_status'
    ];
}
