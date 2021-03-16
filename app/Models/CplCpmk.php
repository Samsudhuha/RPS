<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CplCpmk extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mata_kuliah_id', 'cpl_id', 'cpmk_id'
    ];

    public $timestamps = false;
}
