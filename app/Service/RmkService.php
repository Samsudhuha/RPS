<?php

namespace App\Services;

use App\Repositories\Contracts\RmkRepository;

class RmkService
{
    public function __construct(
        private RmkRepository $rmkRepository
    ) {
    }

    public function getByJurusan($jurusan_id)
    {
        return $this->rmkRepository->getByJurusan($jurusan_id);
    }
}
