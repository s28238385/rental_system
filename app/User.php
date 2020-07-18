<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * 
     * 
     * @var array
     */
    const ROLE_USER='user';
    const ROLE_MANAGER='manager';
    protected $fillable = [
        'name','email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
