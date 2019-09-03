<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventTagRepository")
 */
class MyEventTag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tag", inversedBy="myEventTags")
     */
    private $tagId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEvent", inversedBy="myEventTags")
     */
    private $eventId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTagId(): ?Tag
    {
        return $this->tagId;
    }

    public function setTagId(?Tag $tagId): self
    {
        $this->tagId = $tagId;

        return $this;
    }

    public function getEventId(): ?MyEvent
    {
        return $this->eventId;
    }

    public function setEventId(?MyEvent $eventId): self
    {
        $this->eventId = $eventId;

        return $this;
    }
}
