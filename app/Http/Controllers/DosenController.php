<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pt\CreateDosenRequest;
use App\Http\Requests\Pt\CreateKalabRequest;
use App\Http\Requests\Pt\CreateKaprodiRequest;
use App\Http\Requests\Pt\CreateUserDosenRequest;
use App\Http\Requests\Pt\UpdatePasswordRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Services\DosenService;
use App\Services\ProgramStudiService;
use App\Services\RmkService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    protected $dosenService;
    protected $programStudiService;
    protected $rmkService;
    protected $userService;

    public function __construct(
        DosenService $dosenService,
        UserService $userService,
        ProgramStudiService $programStudiService,
        RmkService $rmkService
    ) {
        $this->dosenService = $dosenService;
        $this->programStudiService = $programStudiService;
        $this->rmkService = $rmkService;
        $this->userService = $userService;
    }

    public function show()
    {
        try {
            $id = Auth::user()->id;
            $data['dosen'] = $this->userService->getById($id);

            return view('dosen.dosen.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function editDosen(UpdateDosenRequest $request)
    {
        try {
            $id = Auth::user()->id;
            $this->userService->update($request->validated(), $id);

            return redirect('rps/dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function editPassword(UpdatePasswordRequest $request)
    {
        try {
            if ($request->oldPassword == $request->newPassword) {
                return redirect('rps/dosen')
                    ->withErrors(["error" => "Password Baru Tidak Boleh Sama Dengan Password Lama!"]);
            }
            $password =  $this->userService->updatePassword($request->validated(), Auth::user()->id);
            if ($password == '0') {
                return redirect('rps/dosen')
                    ->withErrors(["error" => "Password Lama Salah."]);
            } else {
                return redirect('rps/dosen');
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getAll()
    {
        try {
            $id = Auth::user()->id;
            $data['dosens'] = $this->dosenService->getAllDosen($id);
            $data['detail_dosens'] = $this->dosenService->getAllDetailDosen($id);
            $data['kalabs'] = $this->dosenService->getKalabsAll($id);
            $data['kaprodis'] = $this->dosenService->getKaprodiAll($id);
            $data['no'] = 1;

            return view('pt.dosen.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreateDosen()
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();
            $data['id'] = Auth::user()->id;

            return view('pt.dosen.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreateUserDosen()
    {
        try {
            $data['id'] = Auth::user()->id;

            return view('pt.dosen.user.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function storeDosen(CreateDosenRequest $request)
    {
        try {
            $this->dosenService->storeDosen($request->validated());

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function storeUserDosen(CreateUserDosenRequest $request)
    {
        try {
            $this->dosenService->storeUserDosen($request->validated());

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteUserDosen($id)
    {
        try {
            $this->dosenService->deleteUserDosen($id);

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteDosen($id)
    {
        try {
            $this->dosenService->deleteDosen($id);

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteKalab($id)
    {
        try {
            $this->dosenService->deleteKalab($id);

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function deleteKaprodi($id)
    {
        try {
            $this->dosenService->deleteKaprodi($id);

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreateKalab()
    {
        try {
            $data['rmks'] = $this->rmkService->getAll(Auth::user()->id);

            return view('pt.kalab.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function storeKalab(CreateKalabRequest $request)
    {
        try {
            $this->dosenService->storeKalab($request->validated());

            return redirect('dosen');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreatekaprodi()
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();

            return view('pt.kaprodi.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function storekaprodi(CreateKaprodiRequest $request)
    {
        try {
            $kaprodis = $this->dosenService->storeKaprodi($request->validated());
            if ($kaprodis == '0') {
                return redirect('kaprodi/create')
                    ->withErrors(["error" => "Kepala Program Studi Sudah Terisi."]);
            } else {
                return redirect('dosen');
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubDosenByFakultas($fakultas_id)
    {
        try {
            return $this->dosenService->getByFakultas($fakultas_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubDosen($jurusan_id)
    {
        try {
            return $this->dosenService->getByJurusan($jurusan_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubDosenByRmk($rmk_id)
    {
        try {
            return $this->dosenService->getByRmk($rmk_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubDosenByProgramStudiAndJurusan($jurusan_id, $program_studi_id)
    {
        try {
            return $this->dosenService->getByProgramStudiAndJurusan($jurusan_id, $program_studi_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
