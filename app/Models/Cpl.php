<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'jurusan_id', 'no'
    ];

    public $timestamps = false;

    protected $casts = [
        'id' => 'string',
        'jurusan_id' => 'string',
    ];
}
