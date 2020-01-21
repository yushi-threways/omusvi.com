<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventFlowRepository")
 */
class MyEventFlow
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Time
     * @ORM\Column(type="string", nullable=true)
     */
    private $startTime;

    /**
     * @Assert\Time
     * @ORM\Column(type="string", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEvent", inversedBy="myEventFlows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $myEvent;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    
    public function setStartTime(?string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    
    public function getEndTime(): ?string
    {
        return $this->endTime;
    }

   
    public function setEndTime(?string $endTime): self
    {
        $this->endTime = $endTime;
        
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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
}
