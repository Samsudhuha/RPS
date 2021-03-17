<?php

namespace App\Repositories\Contracts;

interface UserRepository
{
    public function create($data);
    public function getById($id);
}
