<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
