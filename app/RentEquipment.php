<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentEquipment extends Model
{
    protected $fillable = [
        'application_id', 'genre', 'item', 'quantity', 'usage', 'remark', 'return_time', 'status', 'rent_by', 'return_by'
    ];
}
