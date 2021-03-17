<?php

namespace App\Http\Controllers;

use App\Services\JurusanService;

class JurusanController extends Controller
{
    protected $jurusanService;

    public function __construct(JurusanService $jurusanService)
    {
        $this->jurusanService = $jurusanService;
    }

    public function getSubJurusan($program_studi_id)
    {
        try {
            $jurusan = $this->jurusanService->getByProgramStudi($program_studi_id);

            return $jurusan;
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
