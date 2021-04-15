<?php

namespace App\Repositories\Contracts;

interface RmkRepository
{
    public function store($data);
    public function update($data, $id);
    public function getByJurusan($jurusan_id);
    public function getAllByJurusan($jurusan_id);
    public function getById($id);
    public function delete($id);
}
