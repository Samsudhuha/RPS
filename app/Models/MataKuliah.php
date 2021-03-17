<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rmk_id',
        'program_studi_id',
        'jurusan_id',
        'kode',
        'name',
        'bobot',
        'semester',
        'deskripsi',
        'bahan_kajian',
        'pustaka'
    ];

    protected $casts = [
        'id' => 'string',
        'rmk_id' => 'string',
        'program_studi_id' => 'string',
        'jurusan_id' => 'string'
    ];
}
