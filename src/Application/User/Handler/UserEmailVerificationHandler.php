<?php

namespace App\Application\User\Handler;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Random\RandomException;

class UserEmailVerificationHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handleVerifyEmail(User $user, string $verificationCode): bool
    {
        if ($user->getVerificationCode() !== $verificationCode) {
            return false;
        }

        $user->setEmailVerified(true);
        $this->userRepository->save($user);

        return true;
    }
}