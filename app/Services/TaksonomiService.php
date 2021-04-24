<?php

namespace App\Services;

use App\Repositories\Contracts\TaksonomiRepository;

class TaksonomiService
{
    protected $taksonomiRepository;

    public function __construct(
        TaksonomiRepository $taksonomiRepository
    ) {
        $this->taksonomiRepository = $taksonomiRepository;
    }

    public function create($params)
    {
        $data = [
            'role' => $params['role'],
            'name' => $params['name'],
        ];

        return $this->taksonomiRepository->create($data);
    }

    public function update($params, $id)
    {
        $data = [
            'username' => $params['nidn'],
            'name' => $params['name'],
        ];
        return $this->userRepository->update($data, $id);
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function getAll($role)
    {
        return $this->taksonomiRepository->getAll($role);
    }

    public function delete($id)
    {
        return $this->taksonomiRepository->delete($id);
    }

    public function cekTaksonomi($data)
    {
        $taksonomi = $this->taksonomiRepository->getAllRole();
        $flag = 0;
        for ($i=0; $i < count($taksonomi); $i++) { 
            if (strpos(strtolower($data['kemampuan_akhir']), strtolower($taksonomi[$i]->name)) !== false) {
                $flag = $taksonomi[$i]->role;
                break;
            }
        }
        if ($flag == 0) {
            return "error";
        } else{
            return $flag;
        }
    }
}
