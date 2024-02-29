<?php

namespace App\Application\User\UseCase;

use App\Domain\Repository\UserRepositoryInterface;

class GetAllUsersStartingWithA
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function execute(): array
    {
        $allUsers = $this->userRepository->getAllUsers();
        $filterUsers = array_filter($allUsers, function ($user) {
            return strtoupper($user->getFirstName()[0]) === 'A';
        });

        return array_values($filterUsers);
    }


}