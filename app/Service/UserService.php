<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(
        userRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    public function getByName($name)
    {
        return $this->userRepository->getByName($name);
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }
}
