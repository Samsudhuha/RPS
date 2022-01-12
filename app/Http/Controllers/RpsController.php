<?php

namespace App\Http\Controllers;

use App\Services\CplCpmkService;
use App\Services\DosenService;
use App\Services\FakultasService;
use App\Services\JurusanService;
use App\Services\MataKuliahService;
use App\Services\ProgramStudiService;
use App\Services\RmkService;
use App\Services\SilabusService;
use App\Services\TaksonomiService;
use App\Services\UserService;
use Illuminate\Http\Request;
use PDF;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RpsController extends Controller
{
    protected $jurusanService;
    protected $programStudiService;
    protected $fakultasService;
    protected $mataKuliahService;
    protected $dosenService;
    protected $cplCpmkService;
    protected $rmkService;
    protected $silabusService;
    protected $userService;
    protected $taksonomiService;
    protected $dosenController;

    public function __construct(
        JurusanService $jurusanService,
        ProgramStudiService $programStudiService,
        FakultasService $fakultasService,
        MataKuliahService $mataKuliahService,
        DosenService $dosenService,
        CplCpmkService $cplCpmkService,
        RmkService $rmkService,
        SilabusService $silabusService,
        UserService $userService,
        TaksonomiService $taksonomiService,
        DosenController $dosenController
    ) {
        $this->jurusanService = $jurusanService;
        $this->programStudiService = $programStudiService;
        $this->fakultasService = $fakultasService;
        $this->mataKuliahService = $mataKuliahService;
        $this->dosenService = $dosenService;
        $this->cplCpmkService = $cplCpmkService;
        $this->rmkService = $rmkService;
        $this->silabusService = $silabusService;
        $this->userService = $userService;
        $this->taksonomiService = $taksonomiService;
        $this->dosenController = $dosenController;
    }

    public function index()
    {
        try {
            $pt_id = Auth::user()->pt_id;
            $data['datas'] = $this->mataKuliahService->getAll($pt_id, 'Dosen');
            $data['no'] = 1;
            return view('dosen.rps.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
    public function getRpsById($id)
    {
        try {
            $data['mata_kuliah'] = $this->mataKuliahService->getMataKuliahById($id, 'Dosen');
            $data['mata_kuliah']['bahan_kajian'] = json_decode($data['mata_kuliah']['bahan_kajian']);
            $data['mata_kuliah_syarat_all'] = $this->mataKuliahService->getMataKuliahSyaratByMk($id);
            $data['mata_kuliah_syarat'] = $this->mataKuliahService->getMataKuliahSyaratById($id);
            $data['program_studi'] = $this->programStudiService->getById($data["mata_kuliah"]["program_studi_id"]);
            $data['fakultas'] = $this->fakultasService->getById($data["mata_kuliah"]["fakultas_id"]);
            $data['jurusan'] = $this->jurusanService->getById($data["mata_kuliah"]["jurusan_id"]);
            $data['rmk'] = $this->rmkService->getRmkById($data['mata_kuliah']["rmk_id"]);
            $data['all_dosens'] = $this->dosenController->getSubDosen($data['mata_kuliah']["jurusan_id"])->toArray();
            $data['dosen_matakuliahs'] = $this->dosenService->getByMataKuliahId($data['mata_kuliah']["id"])->pluck("id")->toArray();
            $data['cpls'] = $this->cplCpmkService->getCplByJurusanAll($data["mata_kuliah"]["jurusan_id"]);
            $data['cpls_array'] = $this->cplCpmkService->getCplByJurusanAll($data["mata_kuliah"]["jurusan_id"])->toArray();
            $data['cpmks'] = $this->cplCpmkService->getCpmkMataKuliahAll($data['mata_kuliah']["id"]);
            $data['remembers'] = $this->taksonomiService->getAll('remember');
            $data['understands'] = $this->taksonomiService->getAll('understand');
            $data['applys'] = $this->taksonomiService->getAll('apply');
            $data['analyzes'] = $this->taksonomiService->getAll('analyze');
            $data['evaluates'] = $this->taksonomiService->getAll('evaluate');
            $data['creates'] = $this->taksonomiService->getAll('create');

            if ($cpl_matakuliahs_id = $this->cplCpmkService->getCplMataKuliahAll($data['mata_kuliah']["id"])) {
                $data['cpl_matakuliahs_id'] = $cpl_matakuliahs_id->pluck("cpl_id")->toArray();
            } else {
                $data['cpl_matakuliahs_id'] = [];
            }
            $data['cpl_cpmks'] = $this->cplCpmkService->getCplCpmkAll($data['mata_kuliah']["id"]);
            $data['silabuses'] = $this->silabusService->getAll($data['mata_kuliah']["id"]);

            $flag_before_role = 'remember';

            if (count($data['silabuses']) == 1) {
                if ($data['silabuses'][0]['role'] != $flag_before_role) {
                    $flag_role_error = 1;
                }else {
                    $flag_role_error = 0;
                }
            } else {
                $flag_role_error = 0;
            }

            for ($i=0; $i < count($data['silabuses']); $i++) {
                if ($data['silabuses'][$i]['role'] == 'remember') {
                    if ($i != 0) {
                        if ('create' != $flag_before_role) {
                            $flag_role_error = 1;
                        }
                    } else {
                        if ('remember' != $flag_before_role) {
                            $flag_role_error = 1;
                        }
                    }
                    $flag_before_role = 'remember';
                }
                else if ($data['silabuses'][$i]['role'] == 'understand') {
                    if ('remember' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'understand';
                }
                else if ($data['silabuses'][$i]['role'] == 'apply') {
                    if ('understand' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'apply';
                }
                else if ($data['silabuses'][$i]['role'] == 'analyze') {
                    if ('apply' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'analyze';
                }
                else if ($data['silabuses'][$i]['role'] == 'evaluate') {
                    if ('analyze' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'evaluate';
                }
                else if ($data['silabuses'][$i]['role'] == 'create') {
                    if ('evaluate' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'create';
                }
            }

            $remember = 0;
            $understand = 0;
            $apply = 0;
            $analyze = 0;
            $evaluate = 0;
            $create = 0;
            $bobot = 0;
            $flag_before_role = 'remember';
            $flag_after_role = '';
            $data['flag_role_error_description'] = [];

            if (count($data['silabuses']) == 1) {
                if ($data['silabuses'][0]['role'] != $flag_before_role) {
                    $flag_role_error = 1;
                }else {
                    $flag_role_error = 0;
                }
            } else {
                $flag_role_error = 0;
            }

            for ($i=0; $i < count($data['silabuses']); $i++) {
                if ($data['silabuses'][$i]['role'] == 'remember') {
                    if ($i != 0) {
                        if ('create' != $flag_before_role && $flag_before_role != 'remember') {
                            $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                            $data['flag_role_error_description'][$i]['role'] = $flag_before_role . ' atau ' . $flag_after_role;
                            $flag_role_error = 1;
                        }
                    } else {
                        if ('remember' != $flag_before_role) {
                            $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                            $data['flag_role_error_description'][$i]['role'] = $flag_before_role;
                            $flag_role_error = 1;
                        }
                    }
                    $flag_before_role = 'remember';
                    $flag_after_role = 'understand';
                    $remember = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'understand') {
                    if ('remember' != $flag_before_role && $flag_before_role != 'understand') {
                        $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                        $data['flag_role_error_description'][$i]['role'] = $flag_before_role . ' atau ' . $flag_after_role;
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'understand';
                    $flag_after_role = 'apply';
                    $understand = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'apply') {
                    if ('understand' != $flag_before_role && $flag_before_role != 'apply') {
                        $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                        $data['flag_role_error_description'][$i]['role'] = $flag_before_role . ' atau ' . $flag_after_role;
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'apply';
                    $flag_after_role = 'analyze';
                    $apply = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'analyze') {
                    if ('apply' != $flag_before_role && $flag_before_role != 'analyze') {
                        $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                        $data['flag_role_error_description'][$i]['role'] = $flag_before_role . ' atau ' . $flag_after_role;
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'analyze';
                    $flag_after_role = 'evaluate';
                    $analyze = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'evaluate') {
                    if ('analyze' != $flag_before_role && $flag_before_role != 'evaluate') {
                        $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                        $data['flag_role_error_description'][$i]['role'] = $flag_before_role . ' atau ' . $flag_after_role;
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'evaluate';
                    $flag_after_role = 'create';
                    $evaluate = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'create') {
                    if ('evaluate' != $flag_before_role && $flag_before_role != 'create') {
                        $data['flag_role_error_description'][$i]['tatap_muka'] = $data['silabuses'][$i]['tatap_muka'];
                        $data['flag_role_error_description'][$i]['role'] = $flag_before_role . ' atau ' . $flag_after_role;
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'create';
                    $flag_after_role = 'remember';
                    $create = 1;
                }
                $bobot = $bobot + (double) $data['silabuses'][$i]['bobot'];

            }

            $data['flag_role_error'] = $flag_role_error;
            if ($remember == 0 || $analyze == 0 || $understand == 0 || $apply == 0 || $evaluate == 0 || $create == 0) {
                $data['flag_role'] = 0;
            } else {
                $data['flag_role'] = 1;
            }
            $data['flag_bobot'] = $bobot;
            return view('dosen.rps.show', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $mata_kuliah = $this->mataKuliahService->getMataKuliahById($id, 'Dosen');
            $this->cplCpmkService->deleteAll($id);
            $this->silabusService->deleteAll($id);
            $this->mataKuliahService->deleteAll($id);

            return redirect('rps')->with('success', 'Berhasil Menghapus Data Rencana Pembelajaran Semester Mata Kuliah ' . $mata_kuliah["name"]);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function cetakPDF($id)
    {
        try {
            $data['mata_kuliah'] = $this->mataKuliahService->getMataKuliahById($id, 'Dosen');
            $data['perguruan_tinggi'] = $this->userService->getById($data['mata_kuliah']['pt_id']);
            $data['mata_kuliah']['bahan_kajian'] = json_decode($data['mata_kuliah']['bahan_kajian']);
            $datetime = new DateTime($data['mata_kuliah']['updated_at']);
            $data['mata_kuliah']['waktu'] = $this->tgl_indo($datetime->format('Y-m-d'));
            $data['mata_kuliah']['kaprodi'] = $this->dosenService->getKaprodiByJurusan($data["mata_kuliah"]["jurusan_id"]);
            $data['fakultas'] = $this->fakultasService->getById($data["mata_kuliah"]["fakultas_id"]);
            $mata_kuliah_syarat = $this->mataKuliahService->getMataKuliahSyaratById($data["mata_kuliah"]["id"]);
            $mk_syarat = [];
            for ($i=0; $i < count($mata_kuliah_syarat); $i++) {
                $mk_syarat[$i] = $this->mataKuliahService->getMataKuliahByMkSyarat($mata_kuliah_syarat[$i])->name;
            }
            $data['mata_kuliah']['mata_kuliah_syarat'] = $mk_syarat;
            $data['mata_kuliah']['kalabs'] = $this->dosenService->getKalabsByRmk($data["mata_kuliah"]["rmk_id"]);
            $data['mata_kuliah']['program_studi'] = $this->programStudiService->getById($data["mata_kuliah"]["program_studi_id"]);
            $data['mata_kuliah']['jurusan'] = $this->jurusanService->getById($data["mata_kuliah"]["jurusan_id"]);
            $data['mata_kuliah']['rmk'] = $this->rmkService->getRmkById($data['mata_kuliah']["rmk_id"]);
            $data['mata_kuliah']['cpmks'] = $this->cplCpmkService->getCpmkMataKuliahAll($data['mata_kuliah']["id"]);
            $data['mata_kuliah']['cpl_matakuliahs'] = $this->cplCpmkService->getCplMataKuliahAll($data['mata_kuliah']["id"])->pluck("cpl_id")->toArray();
            $data['mata_kuliah']['count_cpl_cpmk'] = count($data['mata_kuliah']['cpmks']) + count($data['mata_kuliah']['cpl_matakuliahs']) + 2;
            $data['cpls_array'] = $this->cplCpmkService->getCplByJurusanAll($data["mata_kuliah"]["jurusan_id"])->toArray();
            $data['cpl_cpmks'] = $this->cplCpmkService->getCplCpmkAll($data['mata_kuliah']["id"]);
            $data['silabuses'] = $this->silabusService->getAll($data['mata_kuliah']["id"]);
            $remember = 0;
            $understand = 0;
            $apply = 0;
            $analyze = 0;
            $evaluate = 0;
            $create = 0;
            $bobot = 0;
            $flag_before_role = 'remember';
            if (count($data['silabuses']) == 1) {
                if ($data['silabuses'][0]['role'] != $flag_before_role) {
                    $flag_role_error = 1;
                }else {
                    $flag_role_error = 0;
                }
            } else {
                $flag_role_error = 0;
            }

            for ($i=0; $i < count($data['silabuses']); $i++) {
                if ($data['silabuses'][$i]['role'] == 'remember') {
                    if ($i != 0) {
                        if ('create' != $flag_before_role) {
                            $flag_role_error = 1;
                        }
                    } else {
                        if ('remember' != $flag_before_role) {
                            $flag_role_error = 1;
                        }
                    }
                    $flag_before_role = 'remember';
                    $remember = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'understand') {
                    if ('remember' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'understand';
                    $understand = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'apply') {
                    if ('understand' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'apply';
                    $apply = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'analyze') {
                    if ('apply' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'analyze';
                    $analyze = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'evaluate') {
                    if ('analyze' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'evaluate';
                    $evaluate = 1;
                }
                else if ($data['silabuses'][$i]['role'] == 'create') {
                    if ('evaluate' != $flag_before_role) {
                        $flag_role_error = 1;
                    }
                    $flag_before_role = 'create';
                    $create = 1;
                }
                $bobot = $bobot + (double) $data['silabuses'][$i]['bobot'];

            }
            $flag = 0;
            if (count($data["mata_kuliah"]["cpl_matakuliahs"]) == 0) {
                $flag = 1;
                $errors[0] = "Data Cpl belum terisi.";
            }
            if (count($data["mata_kuliah"]["cpmks"]) == 0) {
                $flag = 1;
                $errors[1] = "Data Cpmk belum terisi.";
            }
            if (count($data["cpl_cpmks"]) == 0) {
                $flag = 1;
                $errors[2] = "Peta Cpl Cpmk belum terisi.";
            }
            if (count($data["silabuses"]) == 0) {
                $flag = 1;
                $errors[3] = "Data Silabus belum terisi.";
            }
            if ($data['mata_kuliah']["kaprodi"] == 0) {
                $flag = 1;
                $errors[4] = "Tidak ada data Kepala Program Studi.";
            }
            if ($data['mata_kuliah']["kalabs"] == 0) {
                $flag = 1;
                $errors[5] = "Tidak ada data Kepala Lab.";
            }
            if ($remember == 0 || $analyze == 0 || $understand == 0 || $apply == 0 || $evaluate == 0 || $create == 0) {
                $flag = 1;
                $errors[6] = "Data silabus belum memenuhi semua sub kata kunci.";
            }
            if ($data['perguruan_tinggi']['logo'] == null) {
                $flag = 1;
                $errors[7] = "Tidak ada logo perguruan tinggi";
            }
            if ((int)$bobot != 100) {
                $flag = 1;
                $errors[8] = "Bobot silabus tidak sama dengan 100";
            }
            if ($flag_role_error == 1) {
                $flag = 1;
                $errors[9] = "Data tatap muka silabus tidak sesuai dengan urutak taksonomi bloom";
            }
            if ($flag == 1) {
                return redirect('rps')->withErrors(["errors" => $errors]);
            } else {
                // dd($data);
                // return view('rps.cetakPDF', $data);
                try{
                    $pdf = PDF::loadview('dosen.rps.cetakPDF', $data)->setPaper('a4', 'landscape');;
                    return $pdf->download('RPS - ' . $data['mata_kuliah']['name'] . '.pdf');
                }catch(DOMPDF_Exception $e){
                    return redirect('rps')->withErrors(["errors" => $e]);
                }
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
