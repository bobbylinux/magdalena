<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that select the database table
     *
     * @var 
     */
    protected $table = "ta001_soci";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        't_usr', 't_pwd'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        't_pwd',
    ];
}
