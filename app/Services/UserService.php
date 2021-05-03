<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(
        userRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function create($params)
    {
        $data = [
            'username' => $params['npsn'],
            'password' => Hash::make('password'),
            'name' => $params['nama'],
            'level' => 'PT',
        ];

        return $this->userRepository->create($data);
    }

    public function updatePhoto($params, $id)
    {
        if (isset($params)) {
            $image = ['logo' => str_replace("public", "storage", $params->file->storeAs('public/images', $id . '.' . $params->file->extension()))];
        }

        return $this->userRepository->update($image, $id);
    }

    public function updatePassword($params, $id)
    {
        $user = $this->userRepository->getById($id);
        if (Hash::check($params['oldPassword'], $user->password)) {
            $password = [
                'password' => Hash::make($params['newPassword'])
            ];

            return $this->userRepository->update($password, $id);
        } else {
            return '0';
        }
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

    public function getAllDosen($pt_id)
    {
        return $this->userRepository->getAllDosen($pt_id);
    }

    public function getAllPT()
    {
        return $this->userRepository->getAllPT();
    }
}
