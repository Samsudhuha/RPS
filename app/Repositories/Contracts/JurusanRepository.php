<?php

namespace App\Repositories\Contracts;

interface JurusanRepository
{
    public function create($data);
    public function getByProgramStudi($program_studi_id);
    public function getById($id);
}
