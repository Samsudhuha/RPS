<?php

namespace App\Repositories\Contracts;

interface FakultasRepository
{
    public function getAll($pt_id);
    public function getById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function getByProgramStudiId($program_studi_id, $pt_id);
}
