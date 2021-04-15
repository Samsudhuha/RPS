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
        'name', 'fakultas_id'
    ];
    protected $casts = [
        'id' => 'string',
        'fakultas_id' => 'string'
    ];
}
