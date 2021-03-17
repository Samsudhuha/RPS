<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'program_studi_id'
    ];
    protected $casts = [
        'id' => 'string',
        'program_studi_id' => 'string'
    ];
}
