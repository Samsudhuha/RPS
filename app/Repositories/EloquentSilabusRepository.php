<?php

namespace App\Repositories;

use App\Models\Silabus;
use App\Repositories\Contracts\SilabusRepository;

class EloquentSilabusRepository implements SilabusRepository
{
    public function create($data)
    {
        return Silabus::create($data);
    }

    public function getAll($mata_kuliah_id)
    {
        return Silabus::where('mata_kuliah_id', $mata_kuliah_id)->orderBy('tatap_muka')->get();
    }

    public function getById($id)
    {
        return Silabus::where('id', $id)->first();
    }

    public function update($data, $id)
    {
        return Silabus::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Silabus::where('id', $id)->delete();
    }

    public function deleteAll($mata_kuliah_id)
    {
        return Silabus::where('mata_kuliah_id', $mata_kuliah_id)->delete();
    }
}
