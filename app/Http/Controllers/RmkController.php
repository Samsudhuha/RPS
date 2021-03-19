<?php

namespace App\Http\Controllers;

use App\Services\RmkService;

class RmkController extends Controller
{
    protected $rmkService;

    public function __construct(RmkService $rmkService)
    {
        $this->rmkService = $rmkService;
    }

    public function getSubRmk($jurusan_id)
    {
        try {
            return $this->rmkService->getByJurusan($jurusan_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
