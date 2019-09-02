<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventApplicationRepository")
 */
class MyEventApplication
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="myEventApplications")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEventSchedule", inversedBy="myEventApplications")
     */
    private $myEventSchedule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMyEventSchedule(): ?MyEventSchedule
    {
        return $this->myEventSchedule;
    }

    public function setMyEventSchedule(?MyEventSchedule $myEventSchedule): self
    {
        $this->myEventSchedule = $myEventSchedule;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
