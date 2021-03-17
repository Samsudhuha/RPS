<?php

namespace App\Repositories\Contracts;

interface CplCpmkRepository
{
    public function getCplAll();
    public function getCpmkAll();
    public function getCplCpmkAll($mata_kuliah_id);
    public function getCplMataKuliahAll($mata_kuliah_id);
    public function getCpmkByName($name_cpmk);
    public function deleteCplCpmk($mata_kuliah_id);
    public function createCpmk($data);
    public function createCpl($data);
}
