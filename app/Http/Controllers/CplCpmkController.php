<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertOrUpdateCplCpmkRequest;
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
}
