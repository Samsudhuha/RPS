<?php

namespace App\Repositories;

use App\Models\Taksonomi;
use App\Repositories\Contracts\TaksonomiRepository;

class EloquentTaksonomiRepository implements TaksonomiRepository
{
    public function create($data)
    {
        return Taksonomi::create($data);
    }

    public function update($data, $id)
    {
        return Taksonomi::where('id', $id)->update($data);
    }

    public function getById($id)
    {
        return Taksonomi::where('id', $id)->first();
    }

    public function delete($id)
    {
        return Taksonomi::where('id', $id)->delete();
    }

    public function getAll($role)
    {
        return Taksonomi::where('role', $role)->get();
    }

    public function getAllRole()
    {
        return Taksonomi::all();
    }
}
