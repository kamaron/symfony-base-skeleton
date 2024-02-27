<?php

namespace App\Domain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
     /**
     * @ORM\Id
     * @ORM\Column(type="uuid") 
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $first_name;

    /**
     * @ORM\Column(type="string")
     */
    private string $last_name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $birthDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $createdAt;

    private function __construct(string $id, string $first_name, string $last_name, string $email, ?string $password, \DateTime $birthDate, \DateTime $createdAt)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->birthDate = $birthDate;
        $this->createdAt = $createdAt;
    }

//    public static function create(string $name, string $email): self
//    {
//        return new self(Uuid::v4()->toRfc4122(), $name, $email, null, new \DateTime());
//    }

    public function getId(): string
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

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

}