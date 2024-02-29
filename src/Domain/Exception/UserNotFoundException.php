<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class UserNotFoundException extends \DomainException
{
    public static function fromEmail(string $email): self
    {
        throw new self(\sprintf('User with email %s not found', $email));
    }
}
