<?php

namespace App\Repositories\Contracts;

interface ProgramStudiRepository
{
    public function getAll();
    public function getById($id);
    public function getByName($name);
}
