<?php

namespace App\Domain\Entity;

use AllowDynamicProperties;
use App\Domain\Exception\InvalidEmailException;
use DateTime;
//use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping as ORM;
use Random\RandomException;

//use Symfony\Component\Uid\Uuid;
//use Symfony\Component\Uid\Ulid;

#[AllowDynamicProperties] #[ORM\Entity]
#[ORM\Table(name: "users")]
class User implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
//    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Domain\Entity\UserIdGenerator')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $first_name;

    #[ORM\Column(type: 'string')]
    private string $last_name;

    #[ORM\Column(type: 'string', unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'datetime')]
    private ?DateTime $birthDate;

    #[ORM\Column(type: 'datetime')]
    private DateTime $createdAt;

    private bool $emailVerified = false;

//    private function __construct(string $id, string $first_name, string $last_name, string $email, ?string $password, \DateTime $birthDate, \DateTime $createdAt)
//    {
//        $this->id = $id;
//        $this->first_name = $first_name;
//        $this->last_name = $last_name;
//        $this->email = $email;
//        $this->password = $password;
//        $this->birthDate = $birthDate;
//        $this->createdAt = $createdAt;
//    }
    private string $verificationCode;

    public static function create(string $first_name, string $last_name, ?string $email = null, $birthDate = null): self
    {

        if (!\filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailException::fromEmail($email);
        }

        $user = new self();
        $user->id = random_int(100000, 999999);
        // fight with uuid, mission aborted, till now!
//        $uid = new Ulid();
//        $user->id = $uid->toRfc4122();
//        $user->id = Uuid::v1();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->birthDate = $birthDate;
        $user->createdAt = new DateTime();
        return $user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setEmail(string $email): void
    {
        if (!\filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailException::fromEmail($email);
        }
        $this->email = $email;
    }

    #[\Override] public function jsonSerialize(): mixed
    {
        return $this->first_name . ' ' . $this->last_name;
//        return [
//            'id' => $this->id,
//            'first_name' => $this->first_name,
//            'last_name' => $this->last_name,
//            'email' => $this->email
//        ];
    }


//    public function __toString(): string
//    {
//        return $this->first_name . ' ' . $this->last_name;
//    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'birthDate' => $this->birthDate->format(\DateTime::RFC3339),
            'createdOn' => $this->createdAt->format(\DateTime::RFC3339)
        ];
    }

    public function getVerificationCode(): string
    {
        return $this->verificationCode;
    }

    public function setVerificationCode(string $code): self
    {
        $this->verificationCode = $code;
        return $this;
    }

    public function setEmailVerified(bool $true): self
    {
        $this->emailVerified = $true;
        return $this;
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}