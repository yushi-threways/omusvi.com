<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $men_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $woman_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $men_count;

    /**
     * @ORM\Column(type="integer")
     */
    private $woman_count;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifiedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenPrice(): ?int
    {
        return $this->men_price;
    }

    public function setMenPrice(int $men_price): self
    {
        $this->men_price = $men_price;

        return $this;
    }

    public function getWomanPrice(): ?int
    {
        return $this->woman_price;
    }

    public function setWomanPrice(int $woman_price): self
    {
        $this->woman_price = $woman_price;

        return $this;
    }

    public function getMenCount(): ?int
    {
        return $this->men_count;
    }

    public function setMenCount(int $men_count): self
    {
        $this->men_count = $men_count;

        return $this;
    }

    public function getWomanCount(): ?int
    {
        return $this->woman_count;
    }

    public function setWomanCount(int $woman_count): self
    {
        $this->woman_count = $woman_count;

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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist() 
    {
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();

        return $this;
    }

    /**
     * @ORM\PostUpdate()
     */
    public function onPostUpdate() 
    {
        $this->modifiedAt = new \DateTime();

        return $this;
    }
}
