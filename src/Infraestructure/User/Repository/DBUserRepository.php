<?php

namespace App\Infraestructure\User\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DBUserRepository implements UserRepositoryInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllUsers(): array
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function createUser(string $first_name, string $last_name, $email): User
    {
        $user = User::create($first_name, $last_name, $email, new \DateTime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    public function getUserFromMail(string $email): User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
    }

    public function save(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}