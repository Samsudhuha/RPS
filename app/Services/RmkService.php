<?php

namespace App\Services;

use App\Repositories\Contracts\FakultasRepository;
use App\Repositories\Contracts\JurusanRepository;
use App\Repositories\Contracts\RmkRepository;

class RmkService
{
    protected $fakultasRepository;
    protected $jurusanRepository;
    protected $rmkRepository;

    public function __construct(
        FakultasRepository $fakultasRepository,
        JurusanRepository $jurusanRepository,
        RmkRepository $rmkRepository
    ) {
        $this->fakultasRepository = $fakultasRepository;
        $this->jurusanRepository = $jurusanRepository;
        $this->rmkRepository = $rmkRepository;
    }

    public function store($params)
    {
        $data = [
            'name' => $params['rmk'],
            'jurusan_id' => $params['jurusan'],
        ];
        return $this->rmkRepository->store($data);
    }

    public function update($params, $id)
    {
        $data = [
            'name' => $params['rmk'],
            'jurusan_id' => $params['jurusan'],
        ];
        return $this->rmkRepository->update($data, $id);
    }

    public function getAll($pt_id)
    {
        $fakultas = $this->fakultasRepository->getAll($pt_id)->pluck('id')->toArray();
        $jurusan_id = $this->jurusanRepository->getAllByFakultasId($fakultas)->pluck('id')->toArray();
        $rmk = $this->rmkRepository->getAllByJurusan($jurusan_id);
        $data = [];
        for ($i = 0; $i < count($rmk); $i++) {
            $jurusan = ['jurusan_name' => $this->jurusanRepository->getById($rmk[$i]['jurusan_id'])->name];
            $data[$i] = array_merge(json_decode(json_encode($jurusan), true), json_decode(json_encode($rmk[$i]), true));
        }

        return $data;
    }

    public function getByJurusan($jurusan_id)
    {
        return $this->rmkRepository->getByJurusan($jurusan_id);
    }

    public function getRmkById($id)
    {
        return $this->rmkRepository->getByid($id);
    }

    public function delete($id)
    {
        return $this->rmkRepository->delete($id);
    }
}
