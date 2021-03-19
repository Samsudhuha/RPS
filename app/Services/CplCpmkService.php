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

    public function getCplAll()
    {
        return $this->cplCpmkRepository->getCplAll();
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

    public function insertOrUpdateCplCpmk($mata_kuliah_id, $data)
    {
        if ($data->cpmk[0] == null) {
            return 'error';
        }
        $this->cplCpmkRepository->deleteCplCpmk($mata_kuliah_id);
        $this->cplCpmkRepository->deleteCpmk($mata_kuliah_id);
        $this->cplCpmkRepository->deleteCplMatakuliah($mata_kuliah_id);

        for ($i = 0; $i < count($data->cpmk); $i++) {
            $cpmk = [
                'mata_kuliah_id' => $mata_kuliah_id,
                'name' => $data->cpmk[$i],
                'no' => $i + 1
            ];
            $cpmk = $this->cplCpmkRepository->createCpmk($cpmk);
        }
        for ($i = 0; $i < count($data->cpl); $i++) {
            $cpl = [
                'mata_kuliah_id' => $mata_kuliah_id,
                'cpl_id' => $data->cpl[$i],
            ];
            $cpmk = $this->cplCpmkRepository->createCpl($cpl);
        }
        return [];
    }

    public function insertOrUpdatePetaCplCpmk($mata_kuliah_id, $data)
    {
        for ($i = 0; $i < count($data->peta); $i++) {
            $cpmk[$i] = (int) explode("|", $data->peta[$i])[0];
            $cpl[$i] = (int) explode("|", $data->peta[$i])[1];
        }
        $jumlahCpmk = $this->getCpmkMataKuliahAll($mata_kuliah_id)->pluck("no")->toArray();
        for ($i = 0; $i < count($jumlahCpmk); $i++) {
            if (!in_array($jumlahCpmk[$i], $cpmk)) {
                return $jumlahCpmk[$i];
            }
        }
        $jurusan_id = $this->mataKuliahRepository->getById($mata_kuliah_id)->jurusan_id;
        $this->cplCpmkRepository->deleteCplCpmk($mata_kuliah_id);
        for ($i = 0; $i < count($data->peta); $i++) {
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
}
