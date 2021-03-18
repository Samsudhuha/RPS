<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertOrUpdateCplCpmkRequest;
use App\Http\Requests\InsertOrUpdatePetaCplCpmkRequest;
use App\Services\CplCpmkService;

class CplCpmkController extends Controller
{
    protected $cplCpmkService;

    public function __construct(CplCpmkService $cplCpmkService)
    {
        $this->cplCpmkService = $cplCpmkService;
    }

    public function insertOrUpdate(InsertOrUpdateCplCpmkRequest $request, $id)
    {
        try {
            $this->cplCpmkService->insertOrUpdateCplCpmk($id, $request);
            return redirect('rps/' . $id)->with('success', 'Berhasil Menyimpan Capaian Pembelajaran');
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function insertOrUpdatePeta(InsertOrUpdatePetaCplCpmkRequest $request, $id)
    {
        try {
            $cpmk = $this->cplCpmkService->insertOrUpdatePetaCplCpmk($id, $request);

            if ($cpmk) {
                return redirect('rps/' . $id)
                    ->withErrors(["error" => "CPMK " . $cpmk . " Belum Terisi"]);
            }
            return redirect('rps/' . $id)->with('success', 'Berhasil Menyimpan Peta CPL - CP MK');
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
