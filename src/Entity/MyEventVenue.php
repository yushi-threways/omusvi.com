<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventVenueRepository")
 */
class MyEventVenue
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $map;

    /**
     * @ORM\Column(type="text")
     */
    private $traffic;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prefecture", inversedBy="myEventVenues")
     */
    private $prefecture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEvent", mappedBy="myEventVenue")
     */
    private $myEvents;

    public function __construct()
    {
        $this->myEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(string $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getTraffic(): ?string
    {
        return $this->traffic;
    }

    public function setTraffic(string $traffic): self
    {
        $this->traffic = $traffic;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPrefecture(): ?Prefecture
    {
        return $this->prefecture;
    }

    public function setPrefecture(?Prefecture $prefecture): self
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    /**
     * @return Collection|MyEvent[]
     */
    public function getMyEvents(): Collection
    {
        return $this->myEvents;
    }

    public function addMyEvent(MyEvent $myEvent): self
    {
        if (!$this->myEvents->contains($myEvent)) {
            $this->myEvents[] = $myEvent;
            $myEvent->setMyEventVenue($this);
        }

        return $this;
    }

    public function removeMyEvent(MyEvent $myEvent): self
    {
        if ($this->myEvents->contains($myEvent)) {
            $this->myEvents->removeElement($myEvent);
            // set the owning side to null (unless already changed)
            if ($myEvent->getMyEventVenue() === $this) {
                $myEvent->setMyEventVenue(null);
            }
        }

        return $this;
    }
}
