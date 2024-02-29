<?php

namespace App\Tests\Application\User\UseCase;

use App\Application\User\UseCase\CreateUser;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{

    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        // store repo
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testCreateUser()
    {
        // load store repo
        $this->userRepository
            ->expects($this->once())
            ->method('createUser')
            ->willReturn(
                User::create('Manu', 'Manu', 'monomario@gmail.com')
            );

        $createUser = new CreateUser($this->userRepository);
        $user = $createUser->execute('Manu', 'Manu', 'monomario@gmail.com');

        $this->assertInstanceOf(User::class, $user);
//        $this->assertEquals('Manu', $user->getFirstName());
//        $this->assertEquals('Manu', $user->getLastName());
        $this->assertObjectHasProperty('first_name', $user);
        $this->assertObjectHasProperty('last_name', $user);
        $this->assertIsInt($user->getId());
        $this->assertIsString($user->getFirstName());
        $this->assertIsString($user->getLastName());

    }
}
