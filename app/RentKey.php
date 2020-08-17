<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentKey extends Model
{
    protected $fillable = [
        'application_id', 'classroom', 'teacher', 'key_type', 'usage', 'remark', 'return_time', 'status', 'rent_by', 'return_by'
    ];
}
