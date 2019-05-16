<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteRepository")
 */
class Favorite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="favorites")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEvent", inversedBy="favorites")
     */
    private $myEvents;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getMyEvents(): ?MyEvent
    {
        return $this->myEvents;
    }

    public function setMyEvents(?MyEvent $myEvents): self
    {
        $this->myEvents = $myEvents;

        return $this;
    }
}
