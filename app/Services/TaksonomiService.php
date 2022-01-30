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

    public function cekTaksonomi($data, $column)
    {
        $taksonomi = $this->taksonomiRepository->getAllRole();
        if ($column == "silabus") {
            $flag = 0;
            for ($i=0; $i < count($taksonomi); $i++) { 
                if (strpos(strtolower($data['kemampuan_akhir']), strtolower($taksonomi[$i]->name)) !== false) {
                    $role = $taksonomi[$i]->role;
                    $flag += 1;
                }
                if ($flag > 1) {
                    break;
                }
            }
            if ($flag == 0) {
                return "kurang--";
            } elseif ($flag == 1) {
                return $role;
            } else {
                return "lebih--";
            }
        } elseif ($column == "cpmk") {
            $flag = 0;
            for ($j=0; $j < count($data['cpmk']); $j++) { 
                for ($i=0; $i < count($taksonomi); $i++) { 
                    if (strpos(strtolower($data['cpmk'][$j]), strtolower($taksonomi[$i]->name)) !== false) {
                        $role = $taksonomi[$i]->role;
                        $flag = 1;
                    }
                }
                if ($flag == 0) {
                    return $j++;
                }
            }
            return "berhasil";
        }
    }
}
