<?php

namespace App\Repositories\Contracts;

interface TaksonomiRepository
{
    public function create($data);
    public function update($data, $id);
    public function getById($id);
    public function delete($id);
    public function getAll($role);
    public function getAllRole();
}
