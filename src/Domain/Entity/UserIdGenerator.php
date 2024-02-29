<?php

namespace App\Domain\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;

class UserIdGenerator extends AbstractIdGenerator
{

    /**
     * @inheritDoc
     */
    public function generateId(EntityManagerInterface $em, ?object $entity): int
    {
        return random_int(100000, 999999);
    }
}