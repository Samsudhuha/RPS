<?php

namespace App\Repositories\Contracts;

interface ProgramStudiRepository
{
    public function getAll();
    public function getByName($name);
}
