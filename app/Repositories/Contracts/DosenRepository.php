<?php

namespace App\Repositories\Contracts;

interface DosenRepository
{
    public function getByJurusan($jurusan_id);
    public function getKaprodiByJurusan($jurusan_id);
    public function getKalabsByRmk($rmk_id);
}
