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
        'program_studi',
        'kode',
        'name',
        'bobot',
        'semester',
        'deskripsi',
        'bahan_kajian',
        'pustaka'
    ];
}
