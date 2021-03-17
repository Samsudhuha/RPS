<?php

namespace App\Services;

use App\Repositories\Contracts\JurusanRepository;

class JurusanService
{
    public function __construct(
        private JurusanRepository $jurusanRepository
    ) {
    }

    public function create($data)
    {
        return $this->jurusanRepository->create($data);
    }

    public function getByName($name)
    {
        return $this->jurusanRepository->getByName($name);
    }

    public function getByProgramStudi($program_studi_id)
    {
        return $this->jurusanRepository->getByProgramStudi($program_studi_id);
    }
}
