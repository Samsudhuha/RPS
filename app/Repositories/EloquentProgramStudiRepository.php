<?php

namespace App\Repositories;

use App\Models\ProgramStudi;
use App\Repositories\Contracts\ProgramStudiRepository;

class EloquentProgramStudiRepository implements ProgramStudiRepository
{
    public function create($data)
    {
        return ProgramStudi::create($data);
    }

    public function getByName($name)
    {
        return ProgramStudi::where('name', $name)->first();
    }
}
