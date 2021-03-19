<?php

namespace App\Repositories\Contracts;

interface SilabusRepository
{
    public function create($data);
    public function update($data, $id);
    public function delete($id);
    public function deleteAll($mata_kuliah_id);
    public function getAll($mata_kuliah_id);
    public function getById($id);
}
