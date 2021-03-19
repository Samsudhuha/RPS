<?php

namespace App\Repositories\Contracts;

interface CplCpmkRepository
{
    public function getCplAll();
    public function getCplByNo($no, $jurusan_id);
    public function getCpmkByNo($no, $mata_kuliah_id);
    public function getCpmkMataKuliahAll($mata_kuliah_id);
    public function getCplCpmkAll($mata_kuliah_id);
    public function getCplMataKuliahAll($mata_kuliah_id);
    public function getCpmkByName($name_cpmk);
    public function deleteCplCpmk($mata_kuliah_id);
    public function deleteCplMatakuliah($mata_kuliah_id);
    public function deleteCpmk($mata_kuliah_id);
    public function createCpmk($data);
    public function createCpl($data);
    public function createCplCpmk($data);
}
