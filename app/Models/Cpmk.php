<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Cpmk extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mata_kuliah_id', 'no'
    ];
    protected $casts = [
        'id' => 'string',
        'mata_kuliah_id' => 'string',
    ];
}
