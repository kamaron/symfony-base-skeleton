<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class InvalidEmailException extends \DomainException
{
    public static function fromEmail(string $email): self
    {
        throw new self(\sprintf('Invalid email %s', $email));
    }
}
