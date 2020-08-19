<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name', 'reason', 'classroom', 'date', 'day', 'begin_time', 'end_time', 'long_term_id'
    ];
}
