<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMataKuliahRequest;
use App\Http\Requests\Pt\CreateMataKuliahRequest as PtCreateMataKuliahRequest;
use App\Http\Requests\Pt\UpdateMataKuliahRequest as PtUpdateMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Services\FakultasService;
use App\Services\JurusanService;
use App\Services\MataKuliahService;
use App\Services\ProgramStudiService;
use App\Services\RmkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
    protected $mataKuliahService;
    protected $programStudiService;
    protected $fakultasService;
    protected $jurusanService;
    protected $rmkService;

    public function __construct(
        MataKuliahService $mataKuliahService,
        ProgramStudiService $programStudiService,
        FakultasService $fakultasService,
        JurusanService $jurusanService,
        RmkService $rmkService
    ) {
        $this->mataKuliahService = $mataKuliahService;
        $this->programStudiService = $programStudiService;
        $this->fakultasService = $fakultasService;
        $this->jurusanService = $jurusanService;
        $this->rmkService = $rmkService;
    }

    public function viewCreate()
    {
        try {
            $level =  Auth::user()->level;
            $data['program_studis'] = $this->programStudiService->getAll();

            if ($level == 'Dosen') {
                $data['id'] = Auth::user()->pt_id;
                return view('dosen.matakuliah.create', $data);
            } elseif ($level == 'PT') {
                $data['id'] = Auth::user()->id;
                return view('pt.matakuliah.create', $data);
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function create(CreateMataKuliahRequest $request)
    {
        try {
            $this->mataKuliahService->create($request->validated(), 'Dosen');
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($request->mata_kuliah, Auth::user()->level);

            return redirect('rps')->with('success', 'Berhasil Menyimpan Data Mata Kuliah ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(PtCreateMataKuliahRequest $request)
    {
        try {
            $this->mataKuliahService->create($request->validated(), 'PT');

            return redirect('matakuliah');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function edit(PtUpdateMataKuliahRequest $request, $id)
    {
        try {
            $this->mataKuliahService->update($request->validated(), $id, Auth::user()->level);

            return redirect('matakuliah');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(UpdateMataKuliahRequest $request, $mata_kuliah_id)
    {
        try {
            $this->mataKuliahService->update($request->validated(), $mata_kuliah_id, Auth::user()->level);
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($mata_kuliah_id, Auth::user()->level);

            return redirect('rps/' . $mata_kuliah_id)->with('success', 'Berhasil Mengubah Data Mata Kuliah ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($mata_kuliah_id)
    {
        try {
            $this->mataKuliahService->delete($mata_kuliah_id);
            return redirect('matakuliah');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getAll()
    {
        try {
            $id = Auth::user()->id;
            $data['matakuliahs'] = $this->mataKuliahService->getAll($id, 'PT');
            $data['no'] = 1;

            return view('pt.matakuliah.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();
            $data['fakultases'] = $this->fakultasService->getAll(Auth::user()->id);
            $data['jurusans'] = $this->jurusanService->getAll(Auth::user()->id);
            $data['rmks'] = $this->rmkService->getAll(Auth::user()->id);
            $data['matakuliah'] = $this->mataKuliahService->getMataKuliahById($id, Auth::user()->level);

            return view('pt.matakuliah.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubMataKuliah($rmk_id)
    {
        try {
            return $this->mataKuliahService->getMataKuliahByRmk($rmk_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubMataKuliahSyarat($mk_id)
    {
        try {
            return $this->mataKuliahService->getMataKuliahSyaratByMk($mk_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
