<?php

namespace App\Repositories;

use App\Models\DosenMataKuliah;
use App\Repositories\Contracts\DosenMataKuliahRepository;

class EloquentDosenMataKuliahRepository implements DosenMataKuliahRepository
{
    public function create($data)
    {
        return DosenMataKuliah::create($data);
    }

    public function getByMataKuliahId($mataKuliahId)
    {
        return DosenMataKuliah::where('mata_kuliah_id', $mataKuliahId)->get();
    }

    public function delete($mataKuliahId)
    {
        return DosenMataKuliah::where('mata_kuliah_id', $mataKuliahId)->delete();
    }
}
