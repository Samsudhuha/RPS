<?php

namespace App\Repositories;

use App\Models\Cpl;
use App\Models\Cpmk;
use App\Models\CplCpmk;
use App\Models\CplMataKuliah;
use App\Repositories\Contracts\CplCpmkRepository;

class EloquentCplCpmkRepository implements CplCpmkRepository
{
    public function createCpmk($data)
    {
        return Cpmk::create($data);
    }

    public function createCpl($data)
    {
        return CplMataKuliah::create($data);
    }

    public function getCplAll()
    {
        return Cpl::orderBy('id')->get();
    }

    public function getCpmkAll()
    {
        return Cpmk::orderBy('id')->get();
    }

    public function getCplCpmkAll($mata_kuliah_id)
    {
        return CplCpmk::where('mata_kuliah_id', $mata_kuliah_id)->get();
    }

    public function getCplMataKuliahAll($mata_kuliah_id)
    {
        return CplMataKuliah::where('mata_kuliah_id', $mata_kuliah_id)->get();
    }

    public function getCpmkByName($name_cpmk)
    {
        return Cpmk::where('name', $name_cpmk)->first();
    }

    public function deleteCplCpmk($mata_kuliah_id)
    {
        return CplCpmk::where('mata_kuliah_id', $mata_kuliah_id)->delete();
    }
}
