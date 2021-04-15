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

    public function update($data, $id)
    {
        return User::where('id', $id)->update($data);
    }

    public function getById($id)
    {
        return User::where('id', $id)->first();
    }

    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }

    public function getAllDosen($pt_id)
    {
        return User::where('pt_id', $pt_id)->where('level', 'Dosen')->get();
    }

    public function getAllPT()
    {
        return User::where('level', 'PT')->get();
    }
}
