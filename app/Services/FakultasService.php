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
        $fakultas = $this->fakultasRepository->getAll($pt_id);
        $data = [];
        for ($i = 0; $i < count($fakultas); $i++) {
            $program_studi = ['program_studi_name' => $this->programStudiRepository->getById($fakultas[$i]['program_studi_id'])->name];
            $data[$i] = array_merge(json_decode(json_encode($program_studi), true), json_decode(json_encode($fakultas[$i]), true));
        }

        return $data;
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
            'program_studi_id' => $params['program_studi'],
        ];
        return $this->fakultasRepository->store($data);
    }

    public function update($params, $id)
    {
        $data = [
            'name' => $params['fakultas'],
            'program_studi_id' => $params['program_studi'],
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
