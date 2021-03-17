<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Rmk extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'jurusan_id'
    ];

    protected $casts = [
        'id' => 'string',
        'jurusan_id' => 'string',
    ];
}
