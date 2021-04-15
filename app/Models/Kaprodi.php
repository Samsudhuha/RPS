<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dosen_id', 'jurusan_id', 'program_studi_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'dosen_id' => 'string',
        'jurusan_id' => 'string',
        'program_studi_id' => 'string'
    ];
}
