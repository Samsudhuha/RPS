<?php

namespace App\Services;

use App\Repositories\Contracts\CplCpmkRepository;

class CplCpmkService
{
    protected $cplCpmkRepository;

    public function __construct(
        CplCpmkRepository $cplCpmkRepository
    ) {
        $this->cplCpmkRepository = $cplCpmkRepository;
    }

    public function getCplAll()
    {
        return $this->cplCpmkRepository->getCplAll();
    }

    public function getCpmkAll()
    {
        return $this->cplCpmkRepository->getCpmkAll();
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
        for ($i = 0; $i < count($data->cpmk); $i++) {
            if ($this->cplCpmkRepository->getCpmkByName($data->cpmk[$i])) {
                dd(1);
            } else {
                $cpmk = [
                    'mata_kuliah_id' => $mata_kuliah_id,
                    'name' => $data->cpmk[$i],
                ];
                $cpmk = $this->cplCpmkRepository->createCpmk($cpmk);
            }
        }
        for ($i = 0; $i < count($data->cpl); $i++) {
            $cpl = [
                'mata_kuliah_id' => $mata_kuliah_id,
                'cpl_id' => $data->cpl[$i],
            ];
            $cpmk = $this->cplCpmkRepository->createCpl($cpl);
        }
        return $this->cplCpmkRepository->getCplCpmkAll($mata_kuliah_id);
    }
}
