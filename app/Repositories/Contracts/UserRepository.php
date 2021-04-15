<?php

namespace App\Repositories\Contracts;

interface UserRepository
{
    public function create($data);
    public function update($data, $id);
    public function getById($id);
    public function delete($id);
    public function getAllDosen($pt_id);
    public function getAllPT();
}
