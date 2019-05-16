<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AcceptRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Accept
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
    private $men_accept;

    /**
     * @ORM\Column(type="integer")
     */
    private $woman_accept;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifiedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEvent", inversedBy="accepts")
     */
    private $myevent;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMenAccept(): ?int
    {
        return $this->men_accept;
    }

    public function setMenAccept(int $men_accept): self
    {
        $this->men_accept = $men_accept;

        return $this;
    }

    public function getWomanAccept(): ?int
    {
        return $this->woman_accept;
    }

    public function setWomanAccept(int $woman_accept): self
    {
        $this->woman_accept = $woman_accept;

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

    public function getMyevent(): ?MyEvent
    {
        return $this->myevent;
    }

    public function setMyevent(?MyEvent $myevent): self
    {
        $this->myevent = $myevent;

        return $this;
    }
}
