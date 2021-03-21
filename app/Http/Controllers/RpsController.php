<?php

namespace App\Http\Controllers;

use App\Services\CplCpmkService;
use App\Services\DosenService;
use App\Services\JurusanService;
use App\Services\MataKuliahService;
use App\Services\ProgramStudiService;
use App\Services\RmkService;
use App\Services\SilabusService;
use Illuminate\Http\Request;
use PDF;

class RpsController extends Controller
{
    protected $jurusanService;
    protected $programStudiService;
    protected $mataKuliahService;
    protected $dosenService;
    protected $cplCpmkService;
    protected $rmkService;
    protected $silabusService;
    protected $dosenController;

    public function __construct(
        JurusanService $jurusanService,
        ProgramStudiService $programStudiService,
        MataKuliahService $mataKuliahService,
        DosenService $dosenService,
        CplCpmkService $cplCpmkService,
        RmkService $rmkService,
        SilabusService $silabusService,
        DosenController $dosenController
    ) {
        $this->jurusanService = $jurusanService;
        $this->programStudiService = $programStudiService;
        $this->mataKuliahService = $mataKuliahService;
        $this->dosenService = $dosenService;
        $this->cplCpmkService = $cplCpmkService;
        $this->rmkService = $rmkService;
        $this->silabusService = $silabusService;
        $this->dosenController = $dosenController;
    }

    public function getRpsById($id)
    {
        try {
            $data['mata_kuliah'] = $this->mataKuliahService->getMataKuliahById($id);
            $data['mata_kuliah']['bahan_kajian'] = json_decode($data['mata_kuliah']['bahan_kajian']);
            $data['program_studi'] = $this->programStudiService->getById($data["mata_kuliah"]["program_studi_id"]);
            $data['jurusan'] = $this->jurusanService->getById($data["mata_kuliah"]["jurusan_id"]);
            $data['rmk'] = $this->rmkService->getRmkById($data['mata_kuliah']["rmk_id"]);
            $data['all_dosens'] = $this->dosenController->getSubDosen($data['mata_kuliah']["jurusan_id"])->toArray();
            $data['dosen_matakuliahs'] = $this->dosenService->getByMataKuliahId($data['mata_kuliah']["id"])->pluck("id")->toArray();
            $data['cpls'] = $this->cplCpmkService->getCplAll();
            $data['cpls_array'] = $this->cplCpmkService->getCplAll()->toArray();
            $data['cpmks'] = $this->cplCpmkService->getCpmkMataKuliahAll($data['mata_kuliah']["id"]);
            if ($cpl_matakuliahs_id = $this->cplCpmkService->getCplMataKuliahAll($data['mata_kuliah']["id"])) {
                $data['cpl_matakuliahs_id'] = $cpl_matakuliahs_id->pluck("cpl_id")->toArray();
            } else {
                $data['cpl_matakuliahs_id'] = [];
            }
            $data['cpl_cpmks'] = $this->cplCpmkService->getCplCpmkAll($data['mata_kuliah']["id"]);
<<<<<<< HEAD
            $data['silabuses'] = $this->silabusService->getAll($data['mata_kuliah']["id"]);

=======
            $data['cpl_matakuliahs_id'] =[];
            // if ($cpl_matakuliahs_id = $this->cplCpmkService->getCplMataKuliahAll($data['mata_kuliah']["id"])) {
            //     dd($cpl_matakuliahs_id);
            //     $data['cpl_matakuliahs_id'] = $cpl_matakuliahs_id->pluck("cpl_id")->toArray();
            // }
>>>>>>> 0c2b96db8e4b4be458d27d2989bd0e2c1c96c96e
            return view('rps.show', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($id);
            $this->cplCpmkService->deleteAll($id);
            $this->silabusService->deleteAll($id);
            $this->mataKuliahService->deleteAll($id);

            return redirect('home')->with('success', 'Berhasil Menghapus Data Rencana Pembelajaran Semester Mata Kuliah ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function cetakPDF($id)
    {
        try {
            return redirect('home')->withErrors(["error" => "Maaf, Cetak PDF Belum Tersedia"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }

        $pdf = PDF::loadview('rps.cetakPDF');
        return $pdf->download('RPS.pdf');
    }

    public function pdf()
    {
        return view('rps.cetakPDF');
    }
}
