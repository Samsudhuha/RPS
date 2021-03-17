<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'jurusan_id'
    ];
    protected $casts = [
        'id' => 'string',
        'jurusan_id' => 'string',
    ];
}
