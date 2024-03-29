<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventVenueRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MyEventVenue
{

    use Timestampable;

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
     * @ORM\Column(type="string", length=500)
     */
    private $map;

    /**
     * @ORM\Column(type="text")
     */
    private $traffic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

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

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $published;

    public function __construct()
    {
        $this->myEvents = new ArrayCollection();
        $this->published = false;
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
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url): self
    {
        $this->url = $url;

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

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        if ($this->published)  {
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return $this->name;
    }
}
