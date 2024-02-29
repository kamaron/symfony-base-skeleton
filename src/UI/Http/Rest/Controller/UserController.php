<?php

namespace App\UI\Http\Rest\Controller;

use App\Application\User\UseCase\CreateUser;
use App\Application\User\UseCase\GetAllUsersStartingWithA;
use App\Application\User\UseCase\GetUserFromMail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class UserController
{
    private GetAllUsersStartingWithA $getAllUsersUseCase;
    private CreateUser $createUserUseCase;
    private GetUserFromMail $getUserFromMailUseCase;

    public function __construct(GetAllUsersStartingWithA $getAllUsersUseCase, CreateUser $createUserUseCase, GetUserFromMail $getUserFromMail)
    {
        $this->getAllUsersUseCase = $getAllUsersUseCase;
        $this->createUserUseCase = $createUserUseCase;
        $this->getUserFromMailUseCase = $getUserFromMail;
    }

    #[Route('/usersWithA', name: 'get_all_users', methods: ['GET'])]
    public function getAllUsers(): JsonResponse
    {
        $users = $this->getAllUsersUseCase->execute();
        return new JsonResponse(['status' => 'ok', 'users' => $users ]);
    }

    #[Route('/createUser', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $data = json_decode($content, true);
        $user = $this->createUserUseCase->execute($data['first_name'], $data['last_name'], $data['email']);
        return new JsonResponse([
            'status' => 'ok',
            'code' => 201,
            'id' => $user->getId(),
            'user' => $user->jsonSerialize(),
            'email' => $user->getEmail()
        ]);
    }

    #[Route('/users/email/{email}', name: 'get_user', methods: ['GET'])]
    public function getUser(string $email): JsonResponse
    {
        $user = $this->getUserFromMailUseCase->execute($email);
        return new JsonResponse([
            'status' => 'ok',
            'code' => 201,
            'data' => [
                'id' => $user->getId(),
                'user' => $user->jsonSerialize(),
                'email' => $user->getEmail()
            ]
        ]);
    }
}