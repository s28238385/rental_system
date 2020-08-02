<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentEquipment extends Model
{
    protected $fillable = [
        'application_id', 'name', 'index', 'quantity', 'usage', 'remark', 'status'
    ];
}
