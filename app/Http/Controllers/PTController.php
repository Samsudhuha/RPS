<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pt\CreatePTRequest;
use App\Http\Requests\Pt\UpdatePasswordRequest;
use App\Http\Requests\Pt\UpdatePhotoRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class PTController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $data['pt'] = $this->userService->getById(Auth::user()->id);
            return view('pt.pt.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function adminPt()
    {
        try {
            $data['datas'] = $this->userService->getAllPT();
            return view('admin.pt.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreate()
    {
        try {
            return view('admin.pt.create');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(CreatePTRequest $request)
    {
        try {
            $this->userService->create($request->validated());

            return redirect('admin/pt');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            if ($request->oldPassword == $request->newPassword) {
                return redirect('pt')
                    ->withErrors(["error" => "Password Baru Tidak Boleh Sama Dengan Password Lama!"]);
            }
            $password =  $this->userService->updatePassword($request->validated(), Auth::user()->id);
            if ($password == '0') {
                return redirect('pt')
                    ->withErrors(["error" => "Password Lama Salah."]);
            } else {
                return redirect('pt');
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function uploadFoto(UpdatePhotoRequest $request)
    {
        try {
            $this->userService->updatePhoto($request, Auth::user()->id);

            return redirect('pt');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
