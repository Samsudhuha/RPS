<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Services\MataKuliahService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private MataKuliahService $mataKuliahService
    ) {
    }

    public function index()
    {
        try {
            $data['datas'] = $this->mataKuliahService->getAll();
            $data['no'] = 1;

            return view('rps.index', $data);
        } catch (\Exception $e) {
            return ["Gagal Load"];
        }
    }
}
