<?php

namespace App\Repositories;

use App\Models\MataKuliah;
use App\Repositories\Contracts\MataKuliahRepository;

class EloquentMataKuliahRepository implements MataKuliahRepository
{
    public function create($data)
    {
        return MataKuliah::create($data);
    }

    public function update($data, $id)
    {
        return MataKuliah::where('id', $id)->update($data);
    }

    public function getAll()
    {
        return MataKuliah::where('deskripsi', '<>', null)
            ->where('bahan_kajian', '<>', null)
            ->where('pustaka', '<>', null)
            ->orderBy('kode')
            ->get();
    }

    public function getByRmkId($rmk_id)
    {
        return MataKuliah::where('deskripsi', null)
            ->where('bahan_kajian', null)
            ->where('pustaka', null)
            ->where('rmk_id', $rmk_id)
            ->orderBy('kode')
            ->get();
    }

    public function getById($id)
    {
        return MataKuliah::where('id', $id)->first();
    }
}
