<?php

namespace App\Http\Controllers;

use App\Http\Requests\Taksonomi\CreateTaksonomiRequest;
use App\Services\TaksonomiService;
use Illuminate\Http\Request;

class TaksonomiBloomController extends Controller
{
    protected $taksonomiRepository;

    public function __construct(TaksonomiService $taksonomiService)
    {
        $this->taksonomiRepository = $taksonomiService;
    }

    public function index()
    {
        try {
            $data['remembers'] = $this->taksonomiRepository->getAll('remember');
            $data['understands'] = $this->taksonomiRepository->getAll('understand');
            $data['applys'] = $this->taksonomiRepository->getAll('apply');
            $data['analyzes'] = $this->taksonomiRepository->getAll('analyze');
            $data['evaluates'] = $this->taksonomiRepository->getAll('evaluate');
            $data['creates'] = $this->taksonomiRepository->getAll('create');
            return view('admin.taksonomi.index', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function viewCreate($role)
    {
        try {
            $data['role'] = $role;

            return view('admin.taksonomi.create', $data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(CreateTaksonomiRequest $request)
    {
        try {
            $this->taksonomiRepository->create($request->validated());

            return redirect('admin/taksonomi-bloom');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $this->taksonomiRepository->delete($id);

            return redirect('admin/taksonomi-bloom');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
