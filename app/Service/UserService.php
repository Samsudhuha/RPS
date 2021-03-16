<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepository;

class UserService
{
    public function __construct(
        private userRepository $userRepository
    ) {
    }

    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    public function getByName($name)
    {
        return $this->userRepository->getByName($name);
    }
}
