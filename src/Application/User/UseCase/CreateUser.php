<?php

namespace App\Application\User\UseCase;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

class CreateUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $first_name, string $last_name, string $email): User
    {
        return $this->userRepository->createUser($first_name, $last_name, $email);
    }
}