<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kalab extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dosen_id', 'rmk_id'
    ];

    public $timestamps = false;
    protected $casts = [
        'dosen_id' => 'string',
        'rmk_id' => 'string'
    ];
}
