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

    public function getByProgramStudi($program_studi_id)
    {
        return Jurusan::where('program_studi_id', $program_studi_id)->get();
    }

    public function getById($id)
    {
        return Jurusan::where('id', $id)->first();
    }
}
