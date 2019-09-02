<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventScheduleRepository")
 */
class MyEventSchedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MyEvent", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $myEvent;

    /**
     * @ORM\Column(type="integer")
     */
    private $womanLimit;

    /**
     * @ORM\Column(type="integer")
     */
    private $manLimit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $eventDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventApplication", mappedBy="myEventSchedule")
     */
    private $myEventApplications;

    public function __construct()
    {
        $this->myEventApplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyEvent(): ?MyEvent
    {
        return $this->myEvent;
    }

    public function setMyEvent(MyEvent $myEvent): self
    {
        $this->myEvent = $myEvent;

        return $this;
    }

    public function getWomanLimit(): ?int
    {
        return $this->womanLimit;
    }

    public function setWomanLimit(int $womanLimit): self
    {
        $this->womanLimit = $womanLimit;

        return $this;
    }

    public function getManLimit(): ?int
    {
        return $this->manLimit;
    }

    public function setManLimit(int $manLimit): self
    {
        $this->manLimit = $manLimit;

        return $this;
    }

    public function getEventDay(): ?\DateTimeInterface
    {
        return $this->eventDay;
    }

    public function setEventDay(\DateTimeInterface $eventDay): self
    {
        $this->eventDay = $eventDay;

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
     * @return Collection|MyEventApplication[]
     */
    public function getMyEventApplications(): Collection
    {
        return $this->myEventApplications;
    }

    public function addMyEventApplication(MyEventApplication $myEventApplication): self
    {
        if (!$this->myEventApplications->contains($myEventApplication)) {
            $this->myEventApplications[] = $myEventApplication;
            $myEventApplication->setMyEventSchedule($this);
        }

        return $this;
    }

    public function removeMyEventApplication(MyEventApplication $myEventApplication): self
    {
        if ($this->myEventApplications->contains($myEventApplication)) {
            $this->myEventApplications->removeElement($myEventApplication);
            // set the owning side to null (unless already changed)
            if ($myEventApplication->getMyEventSchedule() === $this) {
                $myEventApplication->setMyEventSchedule(null);
            }
        }

        return $this;
    }
}
