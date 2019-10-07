<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventApplicationRepository")
 * @ORM\HasLifecycleCallbacks
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

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $menCount;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $womanCount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelled;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        return $this;
    }
    /**
     * @ORM\PostUpdate()
     */
    public function onPostUpdate()
    {
        $this->updatedAt = new \DateTime();
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
}
