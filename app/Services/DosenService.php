<?php

namespace App\Services;

use App\Repositories\Contracts\DosenMataKuliahRepository;
use App\Repositories\Contracts\DosenRepository;
use App\Services\UserService;

class DosenService
{
    protected $dosenRepository;
    protected $dosenMataKuliahRepository;
    protected $userService;

    public function __construct(
        DosenRepository $dosenRepository,
        DosenMataKuliahRepository $dosenMataKuliahRepository,
        UserService $userService
    ) {
        $this->dosenRepository = $dosenRepository;
        $this->dosenMataKuliahRepository = $dosenMataKuliahRepository;
        $this->userService = $userService;
    }

    public function getByJurusan($jurusan_id)
    {
        $dosen = $this->dosenRepository->getByJurusan($jurusan_id);
        for ($i = 0; $i < count($dosen); $i++) {
            $user = $this->userService->getById($dosen[$i]->id);
            $dosen[$i] = [
                "id" => json_decode(json_encode($dosen[$i]["id"], true)),
                "name" => json_decode(json_encode($user->name, true)),
            ];
        }

        return $dosen;
    }

    public function getByMataKuliahId($mata_kuliah_id)
    {
        $dosen = $this->dosenMataKuliahRepository->getByMataKuliahId($mata_kuliah_id);
        for ($i = 0; $i < count($dosen); $i++) {
            $dosen[$i] = [
                "id" => json_decode(json_encode($dosen[$i]["dosen_id"], true)),
            ];
        }

        return $dosen;
    }
}
