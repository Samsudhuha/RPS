<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSilabusRequest;
use App\Services\MataKuliahService;
use App\Services\SilabusService;
use Illuminate\Http\Request;

class SilabusController extends Controller
{
    protected $silabusService;
    protected $mataKuliahService;

    public function __construct(
        SilabusService $silabusService,
        MataKuliahService $mataKuliahService
    ) {
        $this->silabusService = $silabusService;
        $this->mataKuliahService = $mataKuliahService;
    }

    public function viewCreate($id)
    {
        try {
            $data['id'] = $id;
            return view('silabus.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewEdit($id)
    {
        try {
            $data['silabus'] = $this->silabusService->getById($id);

            return view('silabus.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function create(CreateSilabusRequest $request, $id)
    {
        try {
            $this->silabusService->create($request, $id);
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($id);

            return redirect('rps/' . $id)->with('success', 'Berhasil Menambah Data Silabus ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(CreateSilabusRequest $request, $id)
    {
        try {
            $this->silabusService->update($request, $id);
            $id = $this->silabusService->getById($id)->mata_kuliah_id;

            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($id);

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
