<?php

namespace App\Repositories;

use App\Models\Fakultas;
use App\Repositories\Contracts\FakultasRepository;

class EloquentFakultasRepository implements FakultasRepository
{
    public function getAll($pt_id)
    {
        return Fakultas::where('user_id', $pt_id)->get();
    }

    public function getById($id)
    {
        return Fakultas::where('id', $id)->first();
    }

    public function getByProgramStudiId($program_studi_id, $pt_id)
    {
        return Fakultas::where('program_studi_id', $program_studi_id)->where('user_id', $pt_id)->get();
    }

    public function store($data)
    {
        return Fakultas::create($data);
    }

    public function update($data, $id)
    {
        return Fakultas::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Fakultas::where('id', $id)->delete();
    }
}
