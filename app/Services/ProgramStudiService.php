<?php

namespace App\Services;

use App\Repositories\Contracts\ProgramStudiRepository;

class ProgramStudiService
{
    protected $programStudiRepository;

    public function __construct(
        ProgramStudiRepository $programStudiRepository
    ) {
        $this->programStudiRepository = $programStudiRepository;
    }

    public function getAll()
    {
        return $this->programStudiRepository->getAll();
    }

    public function getById($id)
    {
        return $this->programStudiRepository->getById($id);
    }

    public function getByName($name)
    {
        return $this->programStudiRepository->getByName($name);
    }
}
