<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMataKuliahRequest;
use App\Services\MataKuliahService;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    protected $mataKuliahService;

    public function __construct(MataKuliahService $mataKuliahService)
    {
        $this->mataKuliahService = $mataKuliahService;
    }

    public function create(CreateMataKuliahRequest $request)
    {
        try {
            $this->mataKuliahService->create($request->validated());
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($request->mata_kuliah);

            return redirect('home')->with('success', 'Berhasil Menyimpan Data Mata Kuliah ' . $mata_kuliah["name"]);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubMataKuliah($rmk_id)
    {
        try {
            return $this->mataKuliahService->getMataKuliahByRmk($rmk_id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
