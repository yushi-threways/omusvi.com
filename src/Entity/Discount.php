<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiscountRepository")
 */
class Discount
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventTicket", mappedBy="discount")
     */
    private $myEventTickets;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $discountedPrice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $summary;

    public function __construct()
    {
        $this->myEventTickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|MyEventTicket[]
     */
    public function getMyEventTickets(): Collection
    {
        return $this->myEventTickets;
    }

    public function addMyEventTicket(MyEventTicket $myEventTicket): self
    {
        if (!$this->myEventTickets->contains($myEventTicket)) {
            $this->myEventTickets[] = $myEventTicket;
            $myEventTicket->setDiscount($this);
        }

        return $this;
    }

    public function removeMyEventTicket(MyEventTicket $myEventTicket): self
    {
        if ($this->myEventTickets->contains($myEventTicket)) {
            $this->myEventTickets->removeElement($myEventTicket);
            // set the owning side to null (unless already changed)
            if ($myEventTicket->getDiscount() === $this) {
                $myEventTicket->setDiscount(null);
            }
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDiscountedPrice(): ?int
    {
        return $this->discountedPrice;
    }

    public function setDiscountedPrice(int $discountedPrice): self
    {
        $this->discountedPrice = $discountedPrice;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }
}
