<?php

namespace App\Repositories\Contracts;

interface MataKuliahRepository
{
    public function create($data);
    public function update($data, $id);
    public function getAll($pt_id);
    public function getAllMK($pt_id);
    public function getByRmkId($rmk_id);
    public function getById($id);
    public function delete($id);
}
