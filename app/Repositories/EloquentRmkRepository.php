<?php

namespace App\Repositories;

use App\Models\Rmk;
use App\Repositories\Contracts\RmkRepository;

class EloquentRmkRepository implements RmkRepository
{
    public function getByJurusan($jurusan_id)
    {
        return Rmk::where('jurusan_id', $jurusan_id)->get();
    }
}
