<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Taksonomi extends Authenticatable
{
    use UsesUuid;

    protected $fillable = [
        'role',
        'name',
    ];

    protected $casts = [
        'id' => 'string',
    ];
}
