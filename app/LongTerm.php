<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LongTerm extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classroom', 'name', 'reason','startDate','endDate','DayOfWeek','startTime','endTime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];*/
}