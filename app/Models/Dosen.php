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
        'id', 'jurusan_id', 'rmk_id', 'fakultas_id', 'program_studi_id'
    ];
    protected $casts = [
        'id' => 'string',
        'jurusan_id' => 'string',
        'fakultas_id' => 'string',
        'rmk_id' => 'string',
        'program_studi_id' => 'string',
    ];
}
