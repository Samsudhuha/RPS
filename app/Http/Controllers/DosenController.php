<?php

namespace App\Http\Controllers;

use App\Services\DosenService;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function __construct(
        private DosenService $dosenService
    ) {
    }

    public function getSubDosen($jurusan_id)
    {
        try {
            $dosen = $this->dosenService->getByJurusan($jurusan_id);

            return $dosen;
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
