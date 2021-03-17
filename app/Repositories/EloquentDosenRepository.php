<?php

namespace App\Repositories;

use App\Models\Dosen;
use App\Repositories\Contracts\DosenRepository;

class EloquentDosenRepository implements DosenRepository
{
    public function getByJurusan($jurusan_id)
    {
        return Dosen::where('jurusan_id', $jurusan_id)->get();
    }
}
