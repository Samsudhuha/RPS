<?php

namespace App\Services;

use App\Repositories\Contracts\ProgramStudiRepository;

class ProgramStudiService
{
    public function __construct(
        private ProgramStudiRepository $programStudiRepository
    ) {
    }

    public function create($data)
    {
        return $this->programStudiRepository->create($data);
    }

    public function getByName($name)
    {
        return $this->programStudiRepository->getByName($name);
    }
}
