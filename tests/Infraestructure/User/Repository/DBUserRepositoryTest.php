<?php

namespace App\Tests\Infraestructure\User\Repository;

use App\Domain\Entity\User;
use App\Infraestructure\User\Repository\DBUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DBUserRepositoryTest extends KernelTestCase
{
    private DBUserRepository $repository;
    private EntityManagerInterface $entityManager;


    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = new DBUserRepository($this->entityManager);
    }

    public function testCreateUser()
    {
        $user = $this->repository->createUser('Oscar', 'Soriano', 'oso@gmail.com');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Oscar', $user->getFirstName());

        try {

            $fetched = $this->entityManager->find(User::class, $user->getId());
            $this->assertEquals($user, $fetched);

        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    public function testGetUserByEmail()
    {
        $user = new User();
        $user->setEmail('john@doe.com');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $fetched = $this->repository->getUserByEmail('john@doe.com');

        $this->assertEquals($user, $fetched);
    }
}
