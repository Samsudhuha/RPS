<?php

namespace App\Services;

use App\Repositories\Contracts\DosenMataKuliahRepository;
use App\Repositories\Contracts\DosenRepository;
use App\Repositories\Contracts\FakultasRepository;
use App\Repositories\Contracts\JurusanRepository;
use App\Repositories\Contracts\ProgramStudiRepository;
use App\Repositories\Contracts\RmkRepository;
use App\Repositories\Contracts\UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class DosenService
{
    protected $dosenRepository;
    protected $dosenMataKuliahRepository;
    protected $jurusanRepository;
    protected $rmkRepository;
    protected $userRepository;
    protected $programStudiRepository;
    protected $fakultasRepository;
    protected $userService;

    public function __construct(
        DosenRepository $dosenRepository,
        ProgramStudiRepository $programStudiRepository,
        JurusanRepository $jurusanRepository,
        FakultasRepository $fakultasRepository,
        RmkRepository $rmkRepository,
        UserRepository $userRepository,
        DosenMataKuliahRepository $dosenMataKuliahRepository,
        UserService $userService
    ) {
        $this->dosenRepository = $dosenRepository;
        $this->dosenMataKuliahRepository = $dosenMataKuliahRepository;
        $this->jurusanRepository = $jurusanRepository;
        $this->rmkRepository = $rmkRepository;
        $this->userRepository = $userRepository;
        $this->programStudiRepository = $programStudiRepository;
        $this->fakultasRepository = $fakultasRepository;
        $this->userService = $userService;
    }

    public function storeUserDosen($params)
    {
        $data = [
            'pt_id' => $params['user'],
            'username' => $params['nidn'],
            'password' => Hash::make('password'),
            'name' => $params['dosen'],
            'level' => 'Dosen',
        ];
        return $this->userRepository->create($data);
    }

    public function deleteUserDosen($id)
    {
        return $this->userRepository->delete($id);
    }

    public function storeDosen($params)
    {
        $dosen_jurusan = [
            'id' => $params['dosen'],
            'jurusan_id' => $params['jurusan'],
            'rmk_id' => $params['rmk'],
            'fakultas_id' => $params['fakultas'],
            'program_studi_id' => $params['program_studi'],
        ];
        return $this->dosenRepository->store($dosen_jurusan);
    }

    public function deleteDosen($id)
    {
        return $this->dosenRepository->deleteDosen($id);
    }

    public function storeKalab($params)
    {
        $data = [
            'dosen_id' => $params['dosen'],
            'rmk_id' => $params['rmk'],
        ];
        return $this->dosenRepository->storeKalab($data);
    }

    public function deleteKalab($id)
    {
        return $this->dosenRepository->deleteKalab($id);
    }

    public function storeKaprodi($params)
    {
        $kaprodis = $this->dosenRepository->getKaprodisByAll($params['jurusan'], $params['program_studi']);

        if ($kaprodis) {
            return '0';
        }
        $data = [
            'dosen_id' => $params['dosen'],
            'jurusan_id' => $params['jurusan'],
            'program_studi_id' => $params['program_studi'],
        ];
        return $this->dosenRepository->storeKaprodi($data);
    }

    public function deleteKaprodi($id)
    {
        return $this->dosenRepository->deleteKaprodi($id);
    }

    public function getAllDosen($pt_id)
    {
        return $this->userService->getAllDosen($pt_id);
    }

    public function getAllDetailDosen($pt_id)
    {
        $user = $this->userService->getAllDosen($pt_id);
        $data = [];
        for ($i = 0; $i < count($user); $i++) {
            $dosen = $this->dosenRepository->getByIdNotNull($user[$i]->id);
            if ($dosen) {
                $jurusan = ['jurusan_name' => $this->jurusanRepository->getById($dosen->jurusan_id)->name];
                $rmk = ['rmk_name' => $this->rmkRepository->getById($dosen->rmk_id)->name];
                $data[$i] = array_merge(json_decode(json_encode($jurusan), true), json_decode(json_encode($rmk), true), json_decode(json_encode($user[$i]), true));
            }
        }
        return $data;
    }

    public function getKalabsAll($pt_id)
    {
        $user = $this->userService->getAllDosen($pt_id)->pluck('id')->toArray();

        $kalabs = $this->dosenRepository->getKalabsByDosenId($user);
        $data = [];
        for ($i = 0; $i < count($kalabs); $i++) {
            $dosen = [
                'dosen_name' => $this->userRepository->getById($kalabs[$i]->dosen_id)->name,
                'dosen_id' => $kalabs[$i]->dosen_id
            ];
            $rmk = $this->rmkRepository->getById($kalabs[$i]->rmk_id);
            $data[$i] = array_merge(json_decode(json_encode($dosen), true), json_decode(json_encode($rmk), true));
        }
        return $data;
    }

    public function getKaprodiAll($pt_id)
    {
        $user = $this->userService->getAllDosen($pt_id)->pluck('id')->toArray();
        $kaprodi = $this->dosenRepository->getKaprodiByDosenId($user);
        $data = [];
        for ($i = 0; $i < count($kaprodi); $i++) {
            $dosen = [
                'dosen_name' => $this->userRepository->getById($kaprodi[$i]->dosen_id)->name,
                'dosen_id' => $kaprodi[$i]->dosen_id
            ];
            $jurusan = ['jurusan_name' => $this->jurusanRepository->getById($kaprodi[$i]->jurusan_id)->name];
            $program_studi = $this->programStudiRepository->getById($kaprodi[$i]->program_studi_id);
            $data[$i] = array_merge(json_decode(json_encode($jurusan), true), json_decode(json_encode($program_studi), true), json_decode(json_encode($dosen), true));
        }

        return $data;
    }

    public function getByFakultas($fakultas_id)
    {
        $fakultas = $this->fakultasRepository->getById($fakultas_id);

        return $this->userRepository->getAllDosen($fakultas->user_id);
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

    public function getByRmk($rmk_id)
    {
        $dosen = $this->dosenRepository->getByRmk($rmk_id);
        for ($i = 0; $i < count($dosen); $i++) {
            $user = $this->userService->getById($dosen[$i]->id);
            $dosen[$i] = [
                "id" => json_decode(json_encode($dosen[$i]["id"], true)),
                "name" => json_decode(json_encode($user->name, true)),
            ];
        }

        return $dosen;
    }

    public function getByProgramStudiAndJurusan($jurusan_id, $program_studi_id)
    {
        $dosen = $this->dosenRepository->getByProgramStudiAndJurusan($jurusan_id, $program_studi_id);
        for ($i = 0; $i < count($dosen); $i++) {
            $user = $this->userService->getById($dosen[$i]->id);
            $dosen[$i] = [
                "id" => json_decode(json_encode($dosen[$i]["id"], true)),
                "name" => json_decode(json_encode($user->name, true)),
            ];
        }

        return $dosen;
    }

    public function getKaprodiByJurusan($jurusan_id)
    {
        $kaprodi = $this->dosenRepository->getKaprodiByJurusan($jurusan_id);

        if ($kaprodi) {
            return $this->userService->getById($kaprodi->dosen_id)->name;
        } else {
            return 0;
        }
    }

    public function getKalabsByRmk($rmk_id)
    {
        $kalabs = $this->dosenRepository->getKalabsByRmk($rmk_id);

        if ($kalabs) {
            return $this->userService->getById($kalabs->dosen_id)->name;
        } else {
            return 0;
        }
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
