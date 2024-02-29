<?php

namespace App\Tests\Application\User\UseCase;

use App\Application\User\UseCase\GetAllUsersStartingWithA;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class GetAllUsersStartingWithATest extends TestCase
{
    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        // store repo
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testGetAllUsersStartingWithA()
    {
        // load store repo
        $this->userRepository
            ->expects($this->once())
            ->method('getAllUsers')
            ->willReturn([
                User::create('Manu', 'Manu'),
                User::create('Anne', 'Blanco'),
                User::create('Bob', 'Burguer'),
                User::create('Anna', 'Astro')
            ]);

        $getAllUsersStartingWithA = new GetAllUsersStartingWithA($this->userRepository);
        $users = $getAllUsersStartingWithA->execute();

        $this->assertCount(2, $users);
        $this->assertEquals('Anne', $users[0]->getFirstName());
        $this->assertEquals('Anna', $users[1]->getFirstName());
    }
}