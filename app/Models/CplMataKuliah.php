<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class CplMataKuliah extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mata_kuliah_id', 'cpl_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'id' => 'string',
        'mata_kuliah_id' => 'string',
        'cpl_id' => 'string',
    ];
}
