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

    public function createCplCpmk($data)
    {
        return CplCpmk::create($data);
    }

    public function getCplAll()
    {
        return Cpl::orderBy('no')->get();
    }

    public function getCplByNo($no, $jurusan_id)
    {
        return Cpl::where('no', $no)->where('jurusan_id', $jurusan_id)->first();
    }

    public function getCpmkByNo($no, $mata_kuliah_id)
    {
        return Cpmk::where('no', $no)->where('mata_kuliah_id', $mata_kuliah_id)->first();
    }

    public function getCpmkMataKuliahAll($mata_kuliah_id)
    {
        return Cpmk::where('mata_kuliah_id', $mata_kuliah_id)->orderBy('no')->get();
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

    public function deleteCplMatakuliah($mata_kuliah_id)
    {
        return CplMataKuliah::where('mata_kuliah_id', $mata_kuliah_id)->delete();
    }

    public function deleteCpmk($mata_kuliah_id)
    {
        return Cpmk::where('mata_kuliah_id', $mata_kuliah_id)->delete();
    }
}
