<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use UsesUuid;

    protected $table = 'fakultases';
    protected $fillable = [
        'name', 'program_studi_id', 'user_id'
    ];
    protected $casts = [
        'id' => 'string',
        'program_studi_id' => 'string',
        'user_id' => 'string'
    ];
}
