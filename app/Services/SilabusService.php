<?php

namespace App\Services;

use App\Repositories\Contracts\SilabusRepository;
use App\Repositories\Contracts\TaksonomiRepository;

class SilabusService
{
    protected $silabusRepository;
    protected $taksonomiRepository;

    public function __construct(
        SilabusRepository $silabusRepository,
        TaksonomiRepository $taksonomiRepository
    ) {
        $this->silabusRepository = $silabusRepository;
        $this->taksonomiRepository = $taksonomiRepository;
    }

    public function create($data, $id, $role)
    {
        $tatap_muka = implode(',', $data['tatap_muka']);
        $waktu = [
            'tm' => $data['tm'],
            'pt' => $data['pt'],
            'bm' => $data['bm'],
        ];
        $params = [
            'mata_kuliah_id' => $id,
            'tatap_muka' => $tatap_muka,
            'kemampuan_akhir' => $data['kemampuan_akhir'],
            'keluasan' => $data['keluasan'],
            'metode_pembelajaran' => $data['metode_pembelajaran'],
            'estimasi_waktu' => json_encode($waktu, true),
            'kriteria_penilaian' => $data['kriteria_penilaian'],
            'pengamalan' => $data['pengamalan'],
            'bobot' => $data['bobot'],
            'role' => $role
        ];
        return $this->silabusRepository->create($params);
    }

    public function update($data, $id, $role)
    {
        $tatap_muka = implode(',', $data['tatap_muka']);
        $waktu = [
            'tm' => $data['tm'],
            'pt' => $data['pt'],
            'bm' => $data['bm'],
        ];
        $params = [
            'tatap_muka' => $tatap_muka,
            'kemampuan_akhir' => $data['kemampuan_akhir'],
            'keluasan' => $data['keluasan'],
            'metode_pembelajaran' => $data['metode_pembelajaran'],
            'estimasi_waktu' => json_encode($waktu, true),
            'kriteria_penilaian' => $data['kriteria_penilaian'],
            'pengamalan' => $data['pengamalan'],
            'bobot' => $data['bobot'],
            'role' => $role
        ];
        return $this->silabusRepository->update($params, $id);
    }

    public function delete($id)
    {
        return $this->silabusRepository->delete($id);
    }

    public function getAll($id)
    {
        $data =  $this->silabusRepository->getAll($id);

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['estimasi_waktu'] = json_decode($data[$i]['estimasi_waktu']);
        }

        return $data;
    }

    public function getById($id)
    {
        $data =  $this->silabusRepository->getById($id);

        $data['tatap_muka'] = explode(',', $data['tatap_muka']);
        $data['estimasi_waktu'] = json_decode($data['estimasi_waktu']);

        return $data;
    }

    public function deleteAll($mata_kuliah_id)
    {
        return $this->silabusRepository->deleteAll($mata_kuliah_id);
    }
}
