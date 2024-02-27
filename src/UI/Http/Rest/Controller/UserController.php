<?php

namespace App\UI\Http\Rest\Controller;

use App\Application\User\UseCase\GetAllUsers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController
{
    private GetAllUsers $getAllUsersUseCase;

    public function __construct(GetAllUsers $getAllUsersUseCase)
    {
        $this->getAllUsersUseCase = $getAllUsersUseCase;
    }

    #[Route('/users', name: 'get_all_users', methods: ['GET'])]
    public function getAllUsers(): JsonResponse
    {
        $users = $this->getAllUsersUseCase->execute();
        return new JsonResponse($users);
    }
}