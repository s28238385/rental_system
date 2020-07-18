<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ShortTerm extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classroom', 'name', 'reason','date','startTime','endTime','registerTime'
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