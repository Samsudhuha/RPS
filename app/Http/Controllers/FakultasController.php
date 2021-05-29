<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pt\CreateFakultasRequest;
use App\Http\Requests\Pt\UpdateFakultasRequest;
use App\Services\FakultasService;
use App\Services\ProgramStudiService;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    protected $fakultasService;
    protected $programStudiService;

    public function __construct(FakultasService $fakultasService, ProgramStudiService $programStudiService)
    {
        $this->fakultasService = $fakultasService;
        $this->programStudiService = $programStudiService;
    }

    public function viewCreate()
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();
            $data['user_id'] = Auth::user()->id;

            return view('pt.fakultas.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(CreateFakultasRequest $request)
    {
        try {
            $this->fakultasService->store($request->validated());

            return redirect('fakultas');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function edit(UpdateFakultasRequest $request, $id)
    {
        try {
            $this->fakultasService->update($request->validated(), $id);

            return redirect('fakultas');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $this->fakultasService->delete($id);

            return redirect('fakultas');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getAll()
    {
        try {
            $id = Auth::user()->id;
            $data['fakultas'] = $this->fakultasService->getAll($id);
            $data['no'] = 1;

            return view('pt.fakultas.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $data['program_studis'] = $this->programStudiService->getAll();
            $data['user_id'] = Auth::user()->id;
            $data['fakultas'] = $this->fakultasService->getById($id);
            $data['no'] = 1;

            return view('pt.fakultas.edit', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function getSubFakultas($program_studi_id)
    {
        try {
            $level = Auth::user()->level;

            if ($level == 'Dosen') {
                $id = Auth::user()->pt_id;
            } elseif ($level == 'PT') {
                $id = Auth::user()->id;
            }
            return $this->fakultasService->getAll($id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
