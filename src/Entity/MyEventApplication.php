<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints;
use App\DBAL\Types\MyEventApplicationStatusEnumType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventApplicationRepository")
 */
class MyEventApplication
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="myEventApplications", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEventSchedule", inversedBy="myEventApplications")
     */
    private $myEventSchedule;

    /**
     * @var string
     * @ORM\Column(type="MyEventApplicationStatusEnumType", nullable=false)
     * @Constraints\Enum(entity="App\DBAL\Types\MyEventApplicationStatusEnumType")
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $menCount;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $womanCount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelled;

    public function __construct()
    {
        $this->status = MyEventApplicationStatusEnumType::APPLIED;
    }

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

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMenCount(): ?int
    {
        return $this->menCount;
    }

    public function setMenCount(int $menCount): self
    {
        $this->menCount = $menCount;

        return $this;
    }

    public function getWomanCount(): ?int
    {
        return $this->womanCount;
    }

    public function setWomanCount(int $womanCount): self
    {
        $this->womanCount = $womanCount;

        return $this;
    }

    public function getCancelled(): ?\DateTimeInterface
    {
        return $this->cancelled;
    }

    public function setCancelled(?\DateTimeInterface $cancelled): self
    {
        $this->cancelled = $cancelled;

        return $this;
    }

    public function getEvent()
    {
        $event = $this->getMyEventSchedule()->getEvent();
        return $event;
    }

    public function isApplied(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::APPLIED;
    }
    public function isPaied(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::PAIED;
    }
    public function isAccepted(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::ACCEPTED;
    }
    public function isCanceled(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::CANCELED;
    }
    public function isRejected(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::REJECTED;
    }
}
