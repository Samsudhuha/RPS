<?php

namespace App\Services;

use App\Repositories\Contracts\FakultasRepository;
use App\Repositories\Contracts\JurusanRepository;

class JurusanService
{
    protected $jurusanRepository;
    protected $fakultasRepository;

    public function __construct(
        JurusanRepository $jurusanRepository,
        FakultasRepository $fakultasRepository
    ) {
        $this->jurusanRepository = $jurusanRepository;
        $this->fakultasRepository = $fakultasRepository;
    }

    public function store($params)
    {
        $data = [
            'name' => $params['jurusan'],
            'fakultas_id' => $params['fakultas'],
        ];
        return $this->jurusanRepository->store($data);
    }

    public function edit($params, $id)
    {
        $data = [
            'name' => $params['jurusan'],
            'fakultas_id' => $params['fakultas'],
        ];
        return $this->jurusanRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->jurusanRepository->delete($id);
    }

    public function getById($id)
    {
        return $this->jurusanRepository->getById($id);
    }

    public function getByFakultas($fakultas_id)
    {
        return $this->jurusanRepository->getByFakultasId($fakultas_id);
    }

    public function getAll($pt_id)
    {
        $fakultas = $this->fakultasRepository->getAll($pt_id)->pluck('id')->toArray();
        $jurusan = $this->jurusanRepository->getAllByFakultasId($fakultas);
        $data = [];
        for ($i = 0; $i < count($jurusan); $i++) {
            $fakultas = ['fakultas_name' => $this->fakultasRepository->getById($jurusan[$i]['fakultas_id'])->name];
            $data[$i] = array_merge(json_decode(json_encode($fakultas), true), json_decode(json_encode($jurusan[$i]), true));
        }

        return $data;
    }
}
