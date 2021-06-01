<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSilabusRequest;
use App\Services\MataKuliahService;
use App\Services\SilabusService;
use App\Services\TaksonomiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SilabusController extends Controller
{
    protected $silabusService;
    protected $mataKuliahService;
    protected $taksonomiService;

    public function __construct(
        SilabusService $silabusService,
        MataKuliahService $mataKuliahService,
        TaksonomiService $taksonomiService
    ) {
        $this->silabusService = $silabusService;
        $this->mataKuliahService = $mataKuliahService;
        $this->taksonomiService = $taksonomiService;
    }

    public function viewCreate($id)
    {
        try {
            $data['id'] = $id;
            $data['remembers'] = $this->taksonomiService->getAll('remember');
            $data['understands'] = $this->taksonomiService->getAll('understand');
            $data['applys'] = $this->taksonomiService->getAll('apply');
            $data['analyzes'] = $this->taksonomiService->getAll('analyze');
            $data['evaluates'] = $this->taksonomiService->getAll('evaluate');
            $data['creates'] = $this->taksonomiService->getAll('create');
            $data['flag_remember'] = 0;
            $data['flag_understand'] = 0;
            $data['flag_apply'] = 0;
            $data['flag_analyze'] = 0;
            $data['flag_evaluate'] = 0;
            $data['flag_create'] = 0;
            $silabus = $this->silabusService->getAll($id);
            for ($i=0; $i < count($silabus); $i++) { 
                if ($silabus[$i]->role == 'remember') {
                    $data['flag_remember'] = 1;
                }
                if ($silabus[$i]->role == 'understand') {
                    $data['flag_understand'] = 1;
                }
                if ($silabus[$i]->role == 'apply') {
                    $data['flag_apply'] = 1;
                }
                if ($silabus[$i]->role == 'analyze') {
                    $data['flag_analyze'] = 1;
                }
                if ($silabus[$i]->role == 'evaluate') {
                    $data['flag_evaluate'] = 1;
                }
                if ($silabus[$i]->role == 'create') {
                    $data['flag_create'] = 1;
                }
            }
            return view('dosen.silabus.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewEdit($id)
    {
        try {
            $data['silabus'] = $this->silabusService->getById($id, Auth::user()->id);
            $data['remembers'] = $this->taksonomiService->getAll('remember');
            $data['understands'] = $this->taksonomiService->getAll('understand');
            $data['applys'] = $this->taksonomiService->getAll('apply');
            $data['analyzes'] = $this->taksonomiService->getAll('analyze');
            $data['evaluates'] = $this->taksonomiService->getAll('evaluate');
            $data['creates'] = $this->taksonomiService->getAll('create');
            $data['flag_remember'] = 0;
            $data['flag_understand'] = 0;
            $data['flag_apply'] = 0;
            $data['flag_analyze'] = 0;
            $data['flag_evaluate'] = 0;
            $data['flag_create'] = 0;
            $silabus = $this->silabusService->getById($id);
            $silabus = $this->silabusService->getAll($silabus->mata_kuliah_id);
            for ($i=0; $i < count($silabus); $i++) { 
                if ($silabus[$i]->role == 'remember') {
                    $data['flag_remember'] = 1;
                }
                if ($silabus[$i]->role == 'understand') {
                    $data['flag_understand'] = 1;
                }
                if ($silabus[$i]->role == 'apply') {
                    $data['flag_apply'] = 1;
                }
                if ($silabus[$i]->role == 'analyze') {
                    $data['flag_analyze'] = 1;
                }
                if ($silabus[$i]->role == 'evaluate') {
                    $data['flag_evaluate'] = 1;
                }
                if ($silabus[$i]->role == 'create') {
                    $data['flag_create'] = 1;
                }
            }
            
            return view('dosen.silabus.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function create(CreateSilabusRequest $request, $id)
    {
        try {
            $role = $this->taksonomiService->cekTaksonomi($request->validated(), "silabus");
            if ($role == "kurang--") {
                return redirect('rps/silabus/create/' . $id)->withErrors(["error" => "Kata kunci tidak terdeteksi."]);
            } elseif ($role == "lebih--") {
                return redirect('rps/silabus/create/' . $id)->withErrors(["error" => "Kata kunci tidak boleh lebih dari 1."]);
            }
            $this->silabusService->create($request->validated(), $id, $role);
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($id, Auth::user()->level);

            return redirect('rps/' . $id)->with('success', 'Berhasil Menambah Data Silabus ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(CreateSilabusRequest $request, $id)
    {
        try {
            $role = $this->taksonomiService->cekTaksonomi($request->validated(), "silabus");
            if ($role == "kurang--") {
                return redirect('rps/silabus/' . $id)->withErrors(["error" => "Kata kunci tidak terdeteksi."]);
            } elseif ($role == "lebih--") {
                return redirect('rps/silabus/create/' . $id)->withErrors(["error" => "Kata kunci tidak boleh lebih dari 1."]);
            }
            $this->silabusService->update($request->validated(), $id, $role);
            $id = $this->silabusService->getById($id)->mata_kuliah_id;

            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($id, Auth::user()->level);

            return redirect('rps/' . $id)->with('success', 'Berhasil Mengubah Data Silabus ' . $mata_kuliah["name"] . ' ID ' . $id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->silabusService->delete($id);

            return redirect('rps/' . $request->mata_kuliah_id)->with('success', 'Berhasil Menghapus Silabus ID ' . $id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
