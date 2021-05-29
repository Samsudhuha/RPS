<?php

namespace App\Services;

use App\Models\Cpl;
use App\Repositories\Contracts\CplCpmkRepository;
use App\Repositories\Contracts\MataKuliahRepository;

class CplCpmkService
{
    protected $cplCpmkRepository;
    protected $mataKuliahRepository;

    public function __construct(
        CplCpmkRepository $cplCpmkRepository,
        MataKuliahRepository $mataKuliahRepository
    ) {
        $this->cplCpmkRepository = $cplCpmkRepository;
        $this->mataKuliahRepository = $mataKuliahRepository;
    }

    public function getCplByJurusanAll($jurusan_id)
    {
        return $this->cplCpmkRepository->getCplByJurusanAll($jurusan_id);
    }

    public function getCplById($id)
    {
        return $this->cplCpmkRepository->getCplById($id);
    }

    public function getCpmkMataKuliahAll($mata_kuliah_id)
    {
        return $this->cplCpmkRepository->getCpmkMataKuliahAll($mata_kuliah_id);
    }

    public function getCplCpmkAll($mata_kuliah_id)
    {
        return $this->cplCpmkRepository->getCplCpmkAll($mata_kuliah_id);
    }

    public function getCplMatakuliahAll($mata_kuliah_id)
    {
        return $this->cplCpmkRepository->getCplMataKuliahAll($mata_kuliah_id);
    }

    public function insertCpl($params, $jurusan_id)
    {
        $count = count($this->cplCpmkRepository->getCplByJurusanAll($jurusan_id)) + 1;
        $data = [
            'name' => $params['cpl'],
            'no' => $count,
            'jurusan_id' => $jurusan_id,
        ];
        return $this->cplCpmkRepository->createCpl($data);
    }

    public function updateCpl($params, $id)
    {
        $data = [
            'name' => $params['cpl'],
            'no' => $params['nomor'],
        ];
        return $this->cplCpmkRepository->updateCpl($data, $id);
    }

    public function insertOrUpdateCplCpmk($mata_kuliah_id, $data)
    {
        $this->cplCpmkRepository->deleteCplCpmk($mata_kuliah_id);
        $this->cplCpmkRepository->deleteCpmk($mata_kuliah_id);
        $this->cplCpmkRepository->deleteCplMatakuliah($mata_kuliah_id);

        for ($i = 0; $i < 4; $i++) {
            $cpmk = [
                'mata_kuliah_id' => $mata_kuliah_id,
                'name' => $data['cpmk' . $i+1],
                'no' => $i + 1
            ];
            $cpmk = $this->cplCpmkRepository->createCpmk($cpmk);
        }
        for ($i = 0; $i < count($data['cpl']); $i++) {
            $cpl = [
                'mata_kuliah_id' => $mata_kuliah_id,
                'cpl_id' => $data['cpl'][$i],
            ];
            $cpmk = $this->cplCpmkRepository->createCplMataKuliah($cpl);
        }
        return [];
    }

    public function insertOrUpdatePetaCplCpmk($mata_kuliah_id, $data)
    {
        for ($i = 0; $i < count($data['peta']); $i++) {
            $cpmk[$i] = (int) explode("|", $data['peta'][$i])[0];
            $cpl[$i] = (int) explode("|", $data['peta'][$i])[1];
        }
        $jumlahCpmk = $this->getCpmkMataKuliahAll($mata_kuliah_id)->pluck("no")->toArray();
        for ($i = 0; $i < count($jumlahCpmk); $i++) {
            if (!in_array($jumlahCpmk[$i], $cpmk)) {
                return $jumlahCpmk[$i];
            }
        }
        $jurusan_id = $this->mataKuliahRepository->getById($mata_kuliah_id)->jurusan_id;
        $this->cplCpmkRepository->deleteCplCpmk($mata_kuliah_id);
        for ($i = 0; $i < count($data['peta']); $i++) {
            $cpmk_id = $this->cplCpmkRepository->getCpmkByNo($cpmk[$i], $mata_kuliah_id);
            $cpl_id = $this->cplCpmkRepository->getCplByNo($cpl[$i], $jurusan_id);
            $cpl_cpmk = [
                'mata_kuliah_id' => $mata_kuliah_id,
                'cpl_id' => $cpl_id->id,
                'cpmk_id' => $cpmk_id->id,
            ];
            $this->cplCpmkRepository->createCplCpmk($cpl_cpmk);
        }

        return [];
    }

    public function deleteAll($id)
    {
        $this->cplCpmkRepository->deleteCplCpmk($id);
        $this->cplCpmkRepository->deleteCpmk($id);
        $this->cplCpmkRepository->deleteCplMatakuliah($id);
        return [];
    }

    public function deleteCpl($id)
    {
        $this->cplCpmkRepository->deleteCplById($id);
        return [];
    }
}
