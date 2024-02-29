<?php

namespace App\Tests\Application\User\Handler;

use App\Application\User\Handler\UserEmailVerificationHandler;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserEmailVerificationHandlerTest extends TestCase
{
    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    public function testHandleVerifyEmail()
    {
        $user = $this->createDefaultUser();
        $verificationCode = $user->getVerificationCode();

        $this->userRepository
            ->expects($this->once())
            ->method('save')
            ->with($user)
            ->willReturnCallback(function (User $user) {
                $this->assertTrue($user->isEmailVerified());

                $user->setId(1);
            });

        $userEmailVerificationHandler = new UserEmailVerificationHandler($this->userRepository);
        $result = $userEmailVerificationHandler->handleVerifyEmail($user, $verificationCode);

        $this->assertTrue($result);
    }


    public function testHandleVerifyEmailWithInvalidCode()
    {
        $user = $this->createDefaultUser();

        $this->userRepository
            ->expects($this->never())
            ->method('save');

        $userEmailVerificationHandler = new UserEmailVerificationHandler($this->userRepository);
        $result = $userEmailVerificationHandler->handleVerifyEmail($user, '4321');

        $this->assertFalse($result);
    }

    public function createDefaultUser(): User
    {
        $user = User::create('Manu', 'Manu', 'mcamara@gmail.com');

        return $user->setVerificationCode('1234');
    }


}
