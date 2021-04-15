<?php

namespace App\Http\Controllers;

use App\Services\MataKuliahService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $mataKuliahService;
    protected $userService;

    public function __construct(
        MataKuliahService $mataKuliahService,
        UserService $userService
    ) {
        $this->mataKuliahService = $mataKuliahService;
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $pt_id = Auth::user()->id;
            switch (Auth::user()->level) {
                case 'Admin':
                    $data['datas'] = $this->userService->getAllPT();
                    return view('admin.index', $data);
                    break;
                case 'PT':
                    return view('pt.index');
                    break;
                case 'Dosen':
                    return view('dosen.index');
                    break;
                default:
                    Auth::logout();
                    return redirect('/')->with('error', 'user tidak dikenali');
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
