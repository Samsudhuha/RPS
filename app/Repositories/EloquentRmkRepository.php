<?php

namespace App\Repositories;

use App\Models\Rmk;
use App\Repositories\Contracts\RmkRepository;

class EloquentRmkRepository implements RmkRepository
{
    public function store($data)
    {
        return Rmk::create($data);
    }

    public function getByJurusan($jurusan_id)
    {
        return Rmk::where('jurusan_id', $jurusan_id)->get();
    }

    public function getAllByJurusan($jurusan_id)
    {
        return Rmk::whereIn('jurusan_id', $jurusan_id)->get();
    }

    public function getById($id)
    {
        return Rmk::where('id', $id)->first();
    }

    public function delete($id)
    {
        return Rmk::where('id', $id)->delete();
    }

    public function update($data, $id)
    {
        return Rmk::where('id', $id)->update($data);
    }
}
