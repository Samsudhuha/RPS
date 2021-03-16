<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;

class EloquentUsersRepository implements UserRepository
{
    public function create($data)
    {
        return User::create($data);
    }
}
