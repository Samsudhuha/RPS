<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenMataKuliah extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dosen_id', 'mata_kuliah_id'
    ];

    public $timestamps = false;
    protected $casts = [
        'dosen_id' => 'string',
        'program_studi_id' => 'string'
    ];
}
