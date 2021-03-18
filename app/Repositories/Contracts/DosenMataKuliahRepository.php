<?php

namespace App\Repositories\Contracts;

interface DosenMataKuliahRepository
{
    public function create($data);
    public function getByMataKuliahId($mataKuliahId);
    public function delete($mataKuliahId);
}
