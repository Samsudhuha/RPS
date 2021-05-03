<?php

namespace App\Repositories\Contracts;

interface MataKuliahRepository
{
    public function create($data);
    public function update($data, $id);
    public function getAll($pt_id);
    public function getAllMK($pt_id);
    public function getByRmkId($rmk_id);
    public function getMKSyarat($semester, $jurusan_id);
    public function getMKSyaratById($id);
    public function createMKSyarat($data);
    public function getById($id);
    public function delete($id);
    public function deleteMKSyarat($id);
}
