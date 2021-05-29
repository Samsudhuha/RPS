<?php

namespace App\Services;

use App\Repositories\Contracts\DosenMataKuliahRepository;
use App\Repositories\Contracts\FakultasRepository;
use App\Repositories\Contracts\JurusanRepository;
use App\Repositories\Contracts\MataKuliahRepository;
use App\Repositories\Contracts\ProgramStudiRepository;
use App\Repositories\Contracts\RmkRepository;

class MataKuliahService
{
    protected $mataKuliahRepository;
    protected $dosenMataKuliahRepository;
    protected $userService;
    protected $fakultasRepository;
    protected $jurusanRepository;
    protected $programStudiRepository;
    protected $rmkRepository;

    public function __construct(
        MataKuliahRepository $mataKuliahRepository,
        DosenMataKuliahRepository $dosenMataKuliahRepository,
        FakultasRepository $fakultasRepository,
        JurusanRepository $jurusanRepository,
        ProgramStudiRepository $programStudiRepository,
        RmkRepository $rmkRepository,
        UserService $userService
    ) {
        $this->mataKuliahRepository = $mataKuliahRepository;
        $this->dosenMataKuliahRepository = $dosenMataKuliahRepository;
        $this->fakultasRepository = $fakultasRepository;
        $this->jurusanRepository = $jurusanRepository;
        $this->programStudiRepository = $programStudiRepository;
        $this->rmkRepository = $rmkRepository;
        $this->userService = $userService;
    }

    public function create($data, $level)
    {
        if ($level == 'Dosen') {
            $id = $data["mata_kuliah"];
            $pustaka = [
                'pustaka_utama' => json_encode($data["daftar_pustaka_utama"]),
                'pustaka_pendukung' => json_encode($data["daftar_pustaka_pendukung"]),
            ];
            $mata_kuliah = [
                'program_studi_id' => $data["program_studi"],
                'deskripsi' => $data["deskripsi"],
                'bahan_kajian' => json_encode($data["bahan_kajian"]),
                'pustaka' => $pustaka
            ];

            if (isset($data['mata_kuliah_syarat'])) {
                for ($i=0; $i < count($data['mata_kuliah_syarat']); $i++) { 
                    $mata_kuliah_syarat = [
                        'mata_kuliah_id' => $id,
                        'mata_kuliah_syarat_id' => $data['mata_kuliah_syarat'][$i],
                    ];
                    $this->mataKuliahRepository->createMKSyarat($mata_kuliah_syarat);
                }
            }
            for ($i = 0; $i < count($data["dosen"]); $i++) {
                $dosen_mata_kuliah = [
                    'dosen_id' => $data["dosen"][$i],
                    'mata_kuliah_id' => $id
                ];
                $this->dosenMataKuliahRepository->create($dosen_mata_kuliah);
            }

            return $this->mataKuliahRepository->update($mata_kuliah, $id);
        } elseif ($level == 'PT') {
            $params = [
                'name' => $data['matakuliah'],
                'kode' => $data['kode'],
                'bobot' => $data['sks'],
                'semester' => $data['semester'],
                'program_studi_id' => $data['program_studi'],
                'fakultas_id' => $data['fakultas'],
                'jurusan_id' => $data['jurusan'],
                'rmk_id' => $data['rmk'],
                'pt_id' => $data['user'],
            ];
            return $this->mataKuliahRepository->create($params);
        }
    }

    public function update($data, $mata_kuliah_id, $level)
    {
        if ($level == 'PT') {
            $params = [
                'name' => $data['matakuliah'],
                'kode' => $data['kode'],
                'bobot' => $data['sks'],
                'semester' => $data['semester'],
                'program_studi_id' => $data['program_studi'],
                'fakultas_id' => $data['fakultas'],
                'jurusan_id' => $data['jurusan'],
                'rmk_id' => $data['rmk'],
            ];
            return $this->mataKuliahRepository->update($params, $mata_kuliah_id);
        } else if ($level == 'Dosen') {
            $pustaka = [
                'pustaka_utama' => json_encode($data["daftar_pustaka_utama"]),
                'pustaka_pendukung' => json_encode($data["daftar_pustaka_pendukung"]),
            ];
            $mata_kuliah = [
                'deskripsi' => $data["deskripsi"],
                'bahan_kajian' => json_encode($data["bahan_kajian"]),
                'pustaka' => $pustaka
            ];
            $this->dosenMataKuliahRepository->delete($mata_kuliah_id);
            for ($i = 0; $i < count($data["dosen"]); $i++) {
                $dosen_mata_kuliah = [
                    'dosen_id' => $data["dosen"][$i],
                    'mata_kuliah_id' => $mata_kuliah_id
                ];
                $this->dosenMataKuliahRepository->create($dosen_mata_kuliah);
            }

            $this->mataKuliahRepository->deleteMKSyarat($mata_kuliah_id);
            if (isset($data['mata_kuliah_syarat'])) {
                for ($i=0; $i < count($data['mata_kuliah_syarat']); $i++) { 
                    $mata_kuliah_syarat = [
                        'mata_kuliah_id' => $mata_kuliah_id,
                        'mata_kuliah_syarat_id' => $data['mata_kuliah_syarat'][$i],
                    ];
                    $this->mataKuliahRepository->createMKSyarat($mata_kuliah_syarat);
                }
            }

            return $this->mataKuliahRepository->update($mata_kuliah, $mata_kuliah_id);
        }
    }

    public function getAll($pt_id, $level)
    {
        if ($level == "Dosen") {
            $mata_kuliah = $this->mataKuliahRepository->getAll($pt_id);
            $params = [];
            for ($i = 0; $i < count($mata_kuliah); $i++) {
                $dosen = $this->dosenMataKuliahRepository->getByMataKuliahId($mata_kuliah[$i]["id"]);
                $nama_dosen = [];
                for ($j = 0; $j < count($dosen); $j++) {
                    $nama_dosen[$j] =  $this->userService->getById($dosen[$j]["dosen_id"])->name;
                }
                $dosen =  [
                    "dosen" => $nama_dosen
                ];
                $pustaka = json_decode($mata_kuliah[$i]["pustaka"]);
                $pustaka_all = [
                    "pustaka_utama" => json_decode($pustaka->pustaka_utama),
                    "pustaka_pendukung" => json_decode($pustaka->pustaka_pendukung)
                ];
                $params[$i] = array_merge(json_decode(json_encode($dosen), true), json_decode(json_encode($pustaka_all), true), json_decode(json_encode($mata_kuliah[$i]), true));
            }
        } else {
            $mata_kuliah = $this->mataKuliahRepository->getAllMK($pt_id);
            $params = [];
            for ($i = 0; $i < count($mata_kuliah); $i++) {
                $data_pt = [
                    'program_studi_name' => $this->programStudiRepository->getById($mata_kuliah[$i]['program_studi_id'])->name,
                    'fakultas_name' => $this->fakultasRepository->getById($mata_kuliah[$i]['fakultas_id'])->name,
                    'jurusan_name' => $this->jurusanRepository->getById($mata_kuliah[$i]['jurusan_id'])->name,
                    'rmk_name' => $this->rmkRepository->getById($mata_kuliah[$i]['rmk_id'])->name,
                ];
                $params[$i] = array_merge(json_decode(json_encode($data_pt), true), json_decode(json_encode($mata_kuliah[$i]), true));
            }
        }

        return $params;
    }

    public function getMataKuliahByRmk($rmk_id)
    {
        return $this->mataKuliahRepository->getByRmkId($rmk_id);
    }

    public function getMataKuliahByMkSyarat($mk_id)
    {
        return $this->mataKuliahRepository->getById($mk_id);
    }

    public function getMataKuliahSyaratByMk($mk_id)
    {
        $mk = $this->mataKuliahRepository->getById($mk_id);
        return $this->mataKuliahRepository->getMKSyarat($mk->semester, $mk->jurusan_id);
    }

    public function getMataKuliahSyaratById($mk_id)
    {
        $mk = $this->mataKuliahRepository->getMKSyaratById($mk_id);
        $data = [];
        for ($i=0; $i < count($mk); $i++) { 
            $data[$i] = $mk[$i]->mata_kuliah_syarat_id;
        }
        return $data;
    }

    public function getMataKuliahById($id, $level)
    {
        if ($level == 'PT') {
            return $this->mataKuliahRepository->getById($id);
        } else if ($level == 'Dosen') {
            $mata_kuliah = $this->mataKuliahRepository->getById($id);
            $dosen = $this->dosenMataKuliahRepository->getByMataKuliahId($mata_kuliah["id"]);
            $nama_dosen = [];
            for ($j = 0; $j < count($dosen); $j++) {
                $nama_dosen[$j] =  $this->userService->getById($dosen[$j]["dosen_id"])->name;
            }
            $dosen =  [
                "dosen" => $nama_dosen
            ];
            $pustaka = json_decode($mata_kuliah["pustaka"]);
            $pustaka_all = [
                "pustaka_utama" => json_decode($pustaka->pustaka_utama),
                "pustaka_pendukung" => json_decode($pustaka->pustaka_pendukung)
            ];
            $params = array_merge(json_decode(json_encode($dosen), true), json_decode(json_encode($pustaka_all), true), json_decode(json_encode($mata_kuliah), true));

            return $params;
        }
    }

    public function delete($mata_kuliah_id)
    {
        return $this->mataKuliahRepository->delete($mata_kuliah_id);
    }

    public function deleteAll($mata_kuliah_id)
    {
        $this->dosenMataKuliahRepository->delete($mata_kuliah_id);

        $data = [
            'deskripsi' => null,
            'bahan_kajian' => null,
            'pustaka' => null
        ];
        return $this->mataKuliahRepository->update($data, $mata_kuliah_id);
    }
}
