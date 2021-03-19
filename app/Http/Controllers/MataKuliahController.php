<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Services\MataKuliahService;
use App\Services\ProgramStudiService;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    protected $mataKuliahService;
    protected $programStudiService;

    public function __construct(MataKuliahService $mataKuliahService, ProgramStudiService $programStudiService)
    {
        $this->mataKuliahService = $mataKuliahService;
        $this->programStudiService = $programStudiService;
    }

    public function viewCreate()
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();

            return view('matakuliah.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function create(CreateMataKuliahRequest $request)
    {
        try {
            $this->mataKuliahService->create($request->validated());
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($request->mata_kuliah);

            return redirect('home')->with('success', 'Berhasil Menyimpan Data Mata Kuliah ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(UpdateMataKuliahRequest $request, $mata_kuliah_id)
    {
        try {
            $this->mataKuliahService->update($request->validated(), $mata_kuliah_id);
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($mata_kuliah_id);

            return redirect('rps/' . $mata_kuliah_id)->with('success', 'Berhasil Mengubah Data Mata Kuliah ' . $mata_kuliah["name"]);
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
}
