<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function getAllUsers(): array;

    public function createUser(string $first_name, string $last_name, string $email): User;

    public function getUserFromMail(string $email): User;

    public function save(User $user);
}