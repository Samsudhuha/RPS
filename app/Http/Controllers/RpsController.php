<?php

namespace App\Http\Controllers;

use App\Services\CplCpmkService;
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
    protected $cplCpmkService;
    protected $jurusanController;
    protected $rmkController;
    protected $dosenController;

    public function __construct(
        JurusanService $jurusanService,
        ProgramStudiService $programStudiService,
        MataKuliahService $mataKuliahService,
        DosenService $dosenService,
        CplCpmkService $cplCpmkService,
        JurusanController $jurusanController,
        RmkController $rmkController,
        DosenController $dosenController,
    ) {
        $this->jurusanService = $jurusanService;
        $this->programStudiService = $programStudiService;
        $this->mataKuliahService = $mataKuliahService;
        $this->dosenService = $dosenService;
        $this->cplCpmkService = $cplCpmkService;
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
            $data['mata_kuliah']['bahan_kajian'] = json_decode($data['mata_kuliah']['bahan_kajian']);
            $data['program_studis'] = $this->programStudiService->getAll();
            $data['jurusans'] = $this->jurusanController->getSubJurusan($data["mata_kuliah"]["program_studi_id"]);
            $data['rmks'] = $this->rmkController->getSubRmk($data['mata_kuliah']["jurusan_id"]);
            $data['mata_kuliahs'] = $this->mataKuliahService->getAllMataKuliahByRmk($data['mata_kuliah']["rmk_id"]);
            $data['all_dosens'] = $this->dosenController->getSubDosen($data['mata_kuliah']["jurusan_id"])->toArray();
            $data['dosen_matakuliahs'] = $this->dosenService->getByMataKuliahId($data['mata_kuliah']["id"])->pluck("id")->toArray();
            $data['cpls'] = $this->cplCpmkService->getCplAll();
            $data['cpls_array'] = $this->cplCpmkService->getCplAll()->toArray();
            $data['cpmks'] = $this->cplCpmkService->getCpmkAll();
            $data['cpl_cpmks'] = $this->cplCpmkService->getCplCpmkAll($data['mata_kuliah']["id"]);
            $data['cpl_matakuliahs_id'] = $this->cplCpmkService->getCplMataKuliahAll($data['mata_kuliah']["id"])->pluck("cpl_id")->toArray();

            return view('rps.show', $data);
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
