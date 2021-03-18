<?php

namespace App\Repositories\Contracts;

interface RmkRepository
{
    public function getByJurusan($jurusan_id);
    public function getById($id);
}
