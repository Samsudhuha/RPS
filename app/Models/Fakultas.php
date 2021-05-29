<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use UsesUuid;

    protected $table = 'fakultases';
    protected $fillable = [
        'name', 'user_id'
    ];
    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];
}
