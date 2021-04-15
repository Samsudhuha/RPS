<?php

namespace App\Repositories\Contracts;

interface JurusanRepository
{
    public function store($data);
    public function update($data, $id);
    public function getByFakultasId($fakultas_id);
    public function getAllByFakultasId($fakultas_id);
    public function getById($id);
    public function delete($id);
}
