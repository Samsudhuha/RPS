<?php

namespace App\Services;

use App\Repositories\Contracts\DosenMataKuliahRepository;
use App\Repositories\Contracts\MataKuliahRepository;

class MataKuliahService
{
    protected $mataKuliahRepository;
    protected $dosenMataKuliahRepository;
    protected $userService;

    public function __construct(
        MataKuliahRepository $mataKuliahRepository,
        DosenMataKuliahRepository $dosenMataKuliahRepository,
        UserService $userService
    ) {
        $this->mataKuliahRepository = $mataKuliahRepository;
        $this->dosenMataKuliahRepository = $dosenMataKuliahRepository;
        $this->userService = $userService;
    }

    public function create($data)
    {
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

        for ($i = 0; $i < count($data["dosen"]); $i++) {
            $dosen_mata_kuliah = [
                'dosen_id' => $data["dosen"][$i],
                'mata_kuliah_id' => $id
            ];
            $this->dosenMataKuliahRepository->create($dosen_mata_kuliah);
        }

        return $this->mataKuliahRepository->update($mata_kuliah, $id);
    }

    public function update($data, $mata_kuliah_id)
    {
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

        return $this->mataKuliahRepository->update($mata_kuliah, $mata_kuliah_id);
    }

    public function getAll()
    {
        $mata_kuliah = $this->mataKuliahRepository->getAll();
        if (count($mata_kuliah) == 0) {
            return [];
        }
        for ($i = 0; $i < count($mata_kuliah); $i++) {
            $dosen = $this->dosenMataKuliahRepository->getByMataKuliahId($mata_kuliah[$i]["id"]);
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

        return $params;
    }

    public function getMataKuliahByRmk($rmk_id)
    {
        return $this->mataKuliahRepository->getByRmkId($rmk_id);
    }

    public function getMataKuliahById($id)
    {
        $mata_kuliah = $this->mataKuliahRepository->getById($id);
        $dosen = $this->dosenMataKuliahRepository->getByMataKuliahId($mata_kuliah["id"]);
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
