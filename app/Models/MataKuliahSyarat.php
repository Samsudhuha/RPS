<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliahSyarat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mata_kuliah_id',
        'mata_kuliah_syarat_id',
    ];

    protected $casts = [
        'mata_kuliah_id' => 'string',
        'mata_kuliah_syarat_id' => 'string',
    ];
}
