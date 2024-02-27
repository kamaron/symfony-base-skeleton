<?php

namespace App\Application\User\UseCase;

use App\Domain\Repository\UserRepositoryInterface;

class GetAllUsers
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): array
    {
        return $this->userRepository->getAllUsers();
    }


}