<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MyEvent
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $menPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $womanPrice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventFlow", mappedBy="myEvent")
     */
    private $myEventFlows;

    public function __construct()
    {
        $this->myEventFlows = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getMenPrice(): ?int
    {
        return $this->menPrice;
    }

    public function setMenPrice(int $menPrice): self
    {
        $this->menPrice = $menPrice;

        return $this;
    }

    public function getWomanPrice(): ?int
    {
        return $this->womanPrice;
    }

    public function setWomanPrice(int $womanPrice): self
    {
        $this->womanPrice = $womanPrice;

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

    /**
     * @return Collection|MyEventFlow[]
     */
    public function getMyEventFlows(): Collection
    {
        return $this->myEventFlows;
    }

    public function addMyEventFlow(MyEventFlow $myEventFlow): self
    {
        if (!$this->myEventFlows->contains($myEventFlow)) {
            $this->myEventFlows[] = $myEventFlow;
            $myEventFlow->setMyEvent($this);
        }

        return $this;
    }

    public function removeMyEventFlow(MyEventFlow $myEventFlow): self
    {
        if ($this->myEventFlows->contains($myEventFlow)) {
            $this->myEventFlows->removeElement($myEventFlow);
            // set the owning side to null (unless already changed)
            if ($myEventFlow->getMyEvent() === $this) {
                $myEventFlow->setMyEvent(null);
            }
        }

        return $this;
    }
}
