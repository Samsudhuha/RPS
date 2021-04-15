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
        'pt_id',
        'program_studi_id',
        'fakultas_id',
        'jurusan_id',
        'rmk_id',
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
        'pt_id' => 'string',
        'program_studi_id' => 'string',
        'fakultas_id' => 'string',
        'jurusan_id' => 'string',
        'rmk_id' => 'string'
    ];
}
