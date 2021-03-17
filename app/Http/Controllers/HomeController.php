<?php

namespace App\Http\Controllers;

use App\Services\MataKuliahService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $mataKuliahService;

    public function __construct(MataKuliahService $mataKuliahService)
    {
        $this->mataKuliahService = $mataKuliahService;
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
