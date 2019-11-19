<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventScheduleRepository")
 */
class MyEventSchedule
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MyEvent", cascade={"persist", "remove"})
     */
    private $myEvent;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(
     *     message="募集制限を入力してください"
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/u",
     *     message="値が不適切です"
     * )
     *
     */
    private $womanLimit;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(
     *     message="募集制限を入力してください"
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/u",
     *     message="値が不適切です"
     * )
     *
     */
    private $manLimit;

    /**
     * @ORM\Column(type="string")
     */
    private $manTerms;

    /**
     * @ORM\Column(type="string")
     */
    private $womanTerms;

    /**
    * @ORM\Column(type="text")
    */
    private $textTerms;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $eventDay;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventApplication", mappedBy="myEventSchedule")
     */
    private $myEventApplications;

    public function __construct()
    {
        $this->startTime = new \DateTimeImmutable();
        $this->eventDay = new \DateTimeImmutable();
        $this->myEventApplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyEvent(): ?MyEvent
    {
        return $this->myEvent;
    }

    public function setMyEvent(MyEvent $myEvent): self
    {
        $this->myEvent = $myEvent;

        return $this;
    }

    public function getWomanLimit(): ?int
    {
        return $this->womanLimit;
    }

    public function setWomanLimit(int $womanLimit): self
    {
        $this->womanLimit = $womanLimit;

        return $this;
    }

    public function getManLimit(): ?int
    {
        return $this->manLimit;
    }

    public function setManLimit(int $manLimit): self
    {
        $this->manLimit = $manLimit;

        return $this;
    }
    public function getManTerms(): ?string
    {
        return $this->manTerms;
    }

    public function setManTerms(string $manTerms): self
    {
        $this->manTerms = $manTerms;

        return $this;
    }
    public function getWomanTerms(): ?string
    {
        return $this->womanTerms;
    }

    public function setWomanTerms(string $womanTerms): self
    {
        $this->womanTerms = $womanTerms;

        return $this;
    }

    public function getTextTerms(): ?string
    {
        return $this->textTerms;
    }

    public function setTextTerms(string $textTerms): self
    {
        $this->textTerms = $textTerms;

        return $this;
    }

    /**
     * Returns $startTime.
     *
     * @return \DateTimeImmutable | null
     */
    public function getStartTime(): ?\DateTimeImmutable
    {
        return $this->startTime;
    }
    /**
     * Sets startTime.
     *
     * @param  \DateTimeImmutable $startTime
     * @return $this
     */

    public function setStartTime(\DateTimeImmutable $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Returns eventDay.
     *
     * @return \DateTimeImmutable | null
     */
    public function getEventDay(): ?\DateTimeImmutable
    {
        return $this->eventDay;
    }

    /**
     * Sets eventDay.
     *
     * @param  \DateTimeImmutable $eventDay
     * @return $this
     */
    public function setEventDay(\DateTimeImmutable $eventDay): self
    {
        $this->eventDay = $eventDay;

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
            $myEventApplication->setMyEventSchedule($this);
        }

        return $this;
    }

    public function removeMyEventApplication(MyEventApplication $myEventApplication): self
    {
        if ($this->myEventApplications->contains($myEventApplication)) {
            $this->myEventApplications->removeElement($myEventApplication);
            // set the owning side to null (unless already changed)
            if ($myEventApplication->getMyEventSchedule() === $this) {
                $myEventApplication->setMyEventSchedule(null);
            }
        }

        return $this;
    }
}
