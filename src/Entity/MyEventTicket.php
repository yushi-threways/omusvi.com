<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventTicketRepository")
 */
class MyEventTicket
{
    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Gender | null
     * @ORM\Column(type="GenderEnumType", nullable=true)
     * @Constraints\Enum(entity="App\DBAL\Types\GenderEnumType")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberUnit;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sales;

    /**
     * @ORM\Column(type="integer")
     */
    private $limitSheets;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEvent", inversedBy="myEventTickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $myEvent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventApplication", mappedBy="myEventTicket", orphanRemoval=true)
     */
    private $myEventApplications;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discount", inversedBy="myEventTickets")
     */
    private $discount;

    public function __construct()
    {
        $this->myEventApplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getNumberUnit(): ?int
    {
        return $this->numberUnit;
    }

    public function setNumberUnit(int $numberUnit): self
    {
        $this->numberUnit = $numberUnit;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSales(): ?int
    {
        return $this->sales;
    }

    public function setSales(int $sales): self
    {
        $this->sales = $sales;

        return $this;
    }

    public function getLimitSheets(): ?int
    {
        return $this->limitSheets;
    }

    public function setLimitSheets(int $limitSheets): self
    {
        $this->limitSheets = $limitSheets;

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

    public function getMyEvent(): ?MyEvent
    {
        return $this->myEvent;
    }

    public function setMyEvent(?MyEvent $myEvent): self
    {
        $this->myEvent = $myEvent;

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
            $myEventApplication->setMyEventTicket($this);
        }

        return $this;
    }

    public function removeMyEventApplication(MyEventApplication $myEventApplication): self
    {
        if ($this->myEventApplications->contains($myEventApplication)) {
            $this->myEventApplications->removeElement($myEventApplication);
            // set the owning side to null (unless already changed)
            if ($myEventApplication->getMyEventTicket() === $this) {
                $myEventApplication->setMyEventTicket(null);
            }
        }

        return $this;
    }

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function __toString()
    {
        return $this->gender;
    }
}
