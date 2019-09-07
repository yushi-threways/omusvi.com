<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrefectureRepository")
 */
class Prefecture
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
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventVenue", mappedBy="prefecture")
     */
    private $myEventVenues;

    public function __construct()
    {
        $this->myEventVenues = new ArrayCollection();
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
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection|MyEventVenue[]
     */
    public function getMyEventVenues(): Collection
    {
        return $this->myEventVenues;
    }

    public function addMyEventVenue(MyEventVenue $myEventVenue): self
    {
        if (!$this->myEventVenues->contains($myEventVenue)) {
            $this->myEventVenues[] = $myEventVenue;
            $myEventVenue->setPrefecture($this);
        }

        return $this;
    }

    public function removeMyEventVenue(MyEventVenue $myEventVenue): self
    {
        if ($this->myEventVenues->contains($myEventVenue)) {
            $this->myEventVenues->removeElement($myEventVenue);
            // set the owning side to null (unless already changed)
            if ($myEventVenue->getPrefecture() === $this) {
                $myEventVenue->setPrefecture(null);
            }
        }

        return $this;
    }
}
