<?php

namespace App\Http\Controllers;

use App\Services\DosenService;
use App\Services\JurusanService;
use App\Services\MataKuliahService;
use App\Services\ProgramStudiService;
use Illuminate\Http\Request;
use PDF;

class RpsController extends Controller
{
    protected $jurusanService;
    protected $programStudiService;
    protected $mataKuliahService;
    protected $dosenService;
    protected $jurusanController;
    protected $rmkController;
    protected $dosenController;

    public function __construct(
        JurusanService $jurusanService,
        ProgramStudiService $programStudiService,
        MataKuliahService $mataKuliahService,
        DosenService $dosenService,
        JurusanController $jurusanController,
        RmkController $rmkController,
        DosenController $dosenController,
    ) {
        $this->jurusanService = $jurusanService;
        $this->programStudiService = $programStudiService;
        $this->mataKuliahService = $mataKuliahService;
        $this->dosenService = $dosenService;
        $this->jurusanController = $jurusanController;
        $this->rmkController = $rmkController;
        $this->dosenController = $dosenController;
    }

    public function viewCreateRps()
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();

            return view('rps.create', $data);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getRpsById($id)
    {
        try {
            $data['mata_kuliah'] = $this->mataKuliahService->getMataKuliahById($id);
            $data['program_studis'] = $this->programStudiService->getAll();
            $data['jurusans'] = $this->jurusanController->getSubJurusan($data["mata_kuliah"]["program_studi_id"]);
            $data['rmks'] = $this->rmkController->getSubRmk($data['mata_kuliah']["jurusan_id"]);
            $data['mata_kuliahs'] = $this->mataKuliahService->getAllMataKuliahByRmk($data['mata_kuliah']["rmk_id"]);
            $data['all_dosens'] = $this->dosenController->getSubDosen($data['mata_kuliah']["jurusan_id"])->toArray();
            $data['dosen_matakuliahs'] = $this->dosenService->getByMataKuliahId($data['mata_kuliah']["id"])->pluck("id")->toArray();

            return view('rps.rps', $data);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function cetakPDF()
    {
        $pdf = PDF::loadview('rps.cetakPDF');
        return $pdf->download('RPS.pdf');
    }
}
