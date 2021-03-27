<?php

namespace App\Repositories;

use App\Models\Dosen;
use App\Models\Kalab;
use App\Models\Kaprodi;
use App\Repositories\Contracts\DosenRepository;

class EloquentDosenRepository implements DosenRepository
{
    public function getByJurusan($jurusan_id)
    {
        return Dosen::where('jurusan_id', $jurusan_id)->get();
    }

    public function getKaprodiByJurusan($jurusan_id)
    {
        return Kaprodi::where('jurusan_id', $jurusan_id)->first();
    }

    public function getKalabsByRmk($rmk_id)
    {
        return Kalab::where('rmk_id', $rmk_id)->first();
    }
}
