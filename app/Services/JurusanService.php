<?php

namespace App\Services;

use App\Repositories\Contracts\JurusanRepository;

class JurusanService
{
    protected $jurusanRepository;

    public function __construct(
        JurusanRepository $jurusanRepository
    ) {
        $this->jurusanRepository = $jurusanRepository;
    }

    public function create($data)
    {
        return $this->jurusanRepository->create($data);
    }

    public function getByName($name)
    {
        return $this->jurusanRepository->getByName($name);
    }

    public function getById($id)
    {
        return $this->jurusanRepository->getById($id);
    }

    public function getByProgramStudi($program_studi_id)
    {
        return $this->jurusanRepository->getByProgramStudi($program_studi_id);
    }
}
