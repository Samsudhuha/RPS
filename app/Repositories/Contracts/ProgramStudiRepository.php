<?php

namespace App\Repositories\Contracts;

interface ProgramStudiRepository
{
    public function create($data);
    public function getByName($name);
}
