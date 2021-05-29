<?php

namespace App\Services;

use App\Repositories\Contracts\FakultasRepository;
use App\Repositories\Contracts\ProgramStudiRepository;

class FakultasService
{
    protected $fakultasRepository;
    protected $programStudiRepository;

    public function __construct(
        FakultasRepository $fakultasRepository,
        ProgramStudiRepository $programStudiRepository
    ) {
        $this->fakultasRepository = $fakultasRepository;
        $this->programStudiRepository = $programStudiRepository;
    }

    public function getAll($pt_id)
    {
        return $this->fakultasRepository->getAll($pt_id);
    }

    public function getById($id)
    {
        return $this->fakultasRepository->getById($id);
    }

    public function store($params)
    {
        $data = [
            'name' => $params['fakultas'],
            'user_id' => $params['user'],
        ];
        return $this->fakultasRepository->store($data);
    }

    public function update($params, $id)
    {
        $data = [
            'name' => $params['fakultas'],
        ];
        return $this->fakultasRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->fakultasRepository->delete($id);
    }

    public function getByProgramStudi($program_studi_id, $pt_id)
    {
        return $this->fakultasRepository->getByProgramStudiId($program_studi_id, $pt_id);
    }
}
