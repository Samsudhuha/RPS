<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pt\CreateJurusanRequest;
use App\Http\Requests\Pt\UpdateJurusanRequest;
use App\Services\FakultasService;
use App\Services\JurusanService;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    protected $jurusanService;
    protected $fakultasService;

    public function __construct(
        JurusanService $jurusanService,
        FakultasService $fakultasService
    ) {
        $this->jurusanService = $jurusanService;
        $this->fakultasService = $fakultasService;
    }

    public function viewCreate()
    {
        try {
            $data['user_id'] = Auth::user()->id;
            $data['fakultases'] = $this->fakultasService->getAll($data['user_id']);

            return view('pt.jurusan.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(CreateJurusanRequest $request)
    {
        try {
            $this->jurusanService->store($request->validated());

            return redirect('jurusan');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function edit(UpdateJurusanRequest $request, $id)
    {
        try {
            $this->jurusanService->edit($request->validated(), $id);

            return redirect('jurusan');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $this->jurusanService->delete($id);

            return redirect('jurusan');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getAll()
    {
        try {
            $id = Auth::user()->id;
            $data['jurusans'] = $this->jurusanService->getAll($id);
            $data['no'] = 1;

            return view('pt.jurusan.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $data['user_id'] = Auth::user()->id;
            $data['fakultases'] = $this->fakultasService->getAll($data['user_id']);
            $data['jurusan'] = $this->jurusanService->getById($id);

            return view('pt.jurusan.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubJurusan($program_studi_id)
    {
        try {
            return $this->jurusanService->getByFakultas($program_studi_id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
