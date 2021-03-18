<?php

namespace App\Repositories;

use App\Models\ProgramStudi;
use App\Repositories\Contracts\ProgramStudiRepository;

class EloquentProgramStudiRepository implements ProgramStudiRepository
{
    public function getAll()
    {
        return ProgramStudi::orderBy('name')->get();
    }

    public function getByName($name)
    {
        return ProgramStudi::where('name', $name)->first();
    }

    public function getById($id)
    {
        return ProgramStudi::where('id', $id)->first();
    }
}
