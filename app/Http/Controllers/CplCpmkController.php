<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertOrUpdateCplCpmkRequest;
use App\Http\Requests\InsertOrUpdatePetaCplCpmkRequest;
use App\Http\Requests\Pt\CreateCPLRequest;
use App\Http\Requests\Pt\UpdateCPLRequest;
use App\Services\CplCpmkService;
use App\Services\TaksonomiService;

class CplCpmkController extends Controller
{
    protected $cplCpmkService;
    protected $taksonomiService;

    public function __construct(CplCpmkService $cplCpmkService, TaksonomiService $taksonomiService)
    {
        $this->cplCpmkService = $cplCpmkService;
        $this->taksonomiService = $taksonomiService;
    }

    public function getAll($id)
    {
        try {
            $data['cpls'] = $this->cplCpmkService->getCplByJurusanAll($id);
            $data['id'] = $id;

            return view('pt.cpl.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $data['cpl'] = $this->cplCpmkService->getCplById($id);
            $data['id'] = $id;

            return view('pt.cpl.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreate($id)
    {
        try {
            $data['id'] = $id;
            return view('pt.cpl.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(CreateCPLRequest $request, $id)
    {
        try {
            $this->cplCpmkService->insertCpl($request->validated(), $id);

            return redirect('cpl/' . $id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(UpdateCPLRequest $request, $id)
    {
        try {
            $this->cplCpmkService->updateCpl($request->validated(), $id);
            $cpl = $this->cplCpmkService->getCplById($id);

            return redirect('cpl/' . $cpl->jurusan_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $cpl = $this->cplCpmkService->getCplById($id);
            $this->cplCpmkService->deleteCpl($id);

            return redirect('cpl/' . $cpl->jurusan_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function insertOrUpdate(InsertOrUpdateCplCpmkRequest $request, $id)
    {
        try {
            $role = $this->taksonomiService->cekTaksonomi($request->validated(), 'cpmk');

            if ($role != "berhasil") {
                return redirect('rps/' . $id)->withErrors(["error" => "Kata kunci tidak terdeteksi pada CPMK ". $role . "."]);
            } 

            $cplCplmk = $this->cplCpmkService->insertOrUpdateCplCpmk($id, $request->validated());
            if ($cplCplmk) {
                return redirect('rps/' . $id)
                    ->withErrors(["error" => "The cpmk field is required."]);
            }
            return redirect('rps/' . $id)->with('success', 'Berhasil Menyimpan Capaian Pembelajaran');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function insertOrUpdatePeta(InsertOrUpdatePetaCplCpmkRequest $request, $id)
    {
        try {
            $cpmk = $this->cplCpmkService->insertOrUpdatePetaCplCpmk($id, $request->validated());

            if ($cpmk) {
                return redirect('rps/' . $id)
                    ->withErrors(["error" => "CPMK " . $cpmk . " Belum Terisi"]);
            }
            return redirect('rps/' . $id)->with('success', 'Berhasil Menyimpan Peta CPL - CP MK');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
