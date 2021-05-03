<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Silabus extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mata_kuliah_id',
        'tatap_muka',
        'kemampuan_akhir',
        'keluasan',
        'metode_pembelajaran',
        'estimasi_waktu',
        'kriteria_penilaian',
        'pengamalan',
        'bobot',
        'role'
    ];
    protected $casts = [
        'id' => 'string',
        'mata_kuliah_id' => 'string',
    ];
}
