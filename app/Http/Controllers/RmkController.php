<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pt\CreateRmkRequest;
use App\Http\Requests\Pt\UpdateRmkRequest;
use App\Services\JurusanService;
use App\Services\RmkService;
use Illuminate\Support\Facades\Auth;

class RmkController extends Controller
{
    protected $rmkService;
    protected $jurusanService;

    public function __construct(
        RmkService $rmkService,
        JurusanService $jurusanService
    ) {
        $this->rmkService = $rmkService;
        $this->jurusanService = $jurusanService;
    }

    public function viewCreate()
    {
        try {
            $data['user_id'] = Auth::user()->id;
            $data['jurusans'] = $this->jurusanService->getAll($data['user_id']);

            return view('pt.rmk.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $data['user_id'] = Auth::user()->id;
            $data['jurusans'] = $this->jurusanService->getAll($data['user_id']);
            $data['rmk'] = $this->rmkService->getRmkById($id);

            return view('pt.rmk.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(CreateRmkRequest $request)
    {
        try {
            $this->rmkService->store($request->validated());

            return redirect('rmk');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function edit(UpdateRmkRequest $request, $id)
    {
        try {
            $this->rmkService->update($request->validated(), $id);

            return redirect('rmk');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $this->rmkService->delete($id);

            return redirect('rmk');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getAll()
    {
        try {
            $id = Auth::user()->id;
            $data['rmks'] = $this->rmkService->getAll($id);
            $data['no'] = 1;

            return view('pt.rmk.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
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
