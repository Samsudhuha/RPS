<?php

namespace App\Http\Controllers;

use App\Services\RmkService;

class RmkController extends Controller
{
    public function __construct(
        private RmkService $rmkService
    ) {
    }

    public function getSubRmk($jurusan_id)
    {
        try {
            $rmk = $this->rmkService->getByJurusan($jurusan_id);

            return $rmk;
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
