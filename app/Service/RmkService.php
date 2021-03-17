<?php

namespace App\Services;

use App\Repositories\Contracts\RmkRepository;

class RmkService
{
    protected $rmkRepository;

    public function __construct(
        RmkRepository $rmkRepository
    ) {
        $this->rmkRepository = $rmkRepository;
    }

    public function getByJurusan($jurusan_id)
    {
        return $this->rmkRepository->getByJurusan($jurusan_id);
    }
}
