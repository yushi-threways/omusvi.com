<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserDetailRepository")
 */
class UserDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstKana;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastKana;

    /**
     * @ORM\Column(type="integer")
     */
    private $sex;

    /**
     * @ORM\Column(type="integer")
     */
    private $telNumber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="userDetail", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstKana(): ?string
    {
        return $this->firstKana;
    }

    public function setFirstKana(string $firstKana): self
    {
        $this->firstKana = $firstKana;

        return $this;
    }

    public function getLastKana(): ?string
    {
        return $this->lastKana;
    }

    public function setLastKana(string $lastKana): self
    {
        $this->lastKana = $lastKana;

        return $this;
    }

    public function getSex(): ?int
    {
        return $this->sex;
    }

    public function setSex(int $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getTelNumber(): ?int
    {
        return $this->telNumber;
    }

    public function setTelNumber(int $telNumber): self
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
