<?php

namespace App\Repositories;

use App\Models\Jurusan;
use App\Repositories\Contracts\JurusanRepository;

class EloquentJurusanRepository implements JurusanRepository
{
    public function create($data)
    {
        return Jurusan::create($data);
    }
}
