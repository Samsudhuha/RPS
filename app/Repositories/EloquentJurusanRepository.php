<?php

namespace App\Repositories;

use App\Models\Jurusan;
use App\Repositories\Contracts\JurusanRepository;

class EloquentJurusanRepository implements JurusanRepository
{
    public function store($data)
    {
        return Jurusan::create($data);
    }

    public function getByFakultasId($fakultas_id)
    {
        return Jurusan::where('fakultas_id', $fakultas_id)->get();
    }

    public function getAllByFakultasId($fakultas_id)
    {
        return Jurusan::whereIn('fakultas_id', $fakultas_id)->orderBy('fakultas_id')->get();
    }

    public function getById($id)
    {
        return Jurusan::where('id', $id)->first();
    }

    public function delete($id)
    {
        return Jurusan::where('id', $id)->delete();
    }

    public function update($data, $id)
    {
        return Jurusan::where('id', $id)->update($data);
    }
}
