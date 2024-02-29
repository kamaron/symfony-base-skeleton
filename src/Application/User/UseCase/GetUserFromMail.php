<?php

namespace App\Application\User\UseCase;

use App\Domain\Entity\User;
use App\Domain\Exception\UserNotFoundException;
use App\Domain\Repository\UserRepositoryInterface;

class GetUserFromMail
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $email): User
    {
        $user = $this->userRepository->getUserFromMail($email);
        return $user;
    }
}