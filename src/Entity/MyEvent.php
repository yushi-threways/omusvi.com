<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class MyEvent
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     *  @Assert\Length(
     *     max = 50,
     *     maxMessage = "This value should not be longer than {{ limit }} characters."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max = 1000,
     *     maxMessage = "This value should not be longer than {{ limit }} characters."
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $menPrice;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $womanPrice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventFlow", mappedBy="myEvent", cascade={"persist"})
     */
    private $myEventFlows;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="my_event_image", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist"})
     * @ORM\JoinTable(name="my_event_tag")
     * @ORM\OrderBy({"name": "ASC"})
     * @Assert\Count(max="4", maxMessage="post.too_many_tags")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEventVenue", inversedBy="myEvents")
     */
    private $myEventVenue;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MyEventSchedule", cascade={"persist", "remove"})
     */
    private $myEventSchedule;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $published;

    /**
     * @var \DateTimeImmutable | null
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $startAt;

    /**
     * @var \DateTimeImmutable | null
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $endAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $maleSeats;

    /**
     * @ORM\Column(type="integer")
     */
    private $femaleSeats;

    /**
     * @ORM\Column(type="integer")
     */
    private $maleAgeLower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maleAgeUpper;

    /**
     * @ORM\Column(type="integer")
     */
    private $femaleAgeLower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $femaleAgeUpper;

    public function __construct()
    {
        $this->published = false;
        $this->startAt = new \DateTimeImmutable();
        $this->endAt = new \DateTimeImmutable();
        $this->myEventFlows = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function addTag(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getMyEventVenue(): ?MyEventVenue
    {
        return $this->myEventVenue;
    }

    public function setMyEventVenue(?MyEventVenue $myEventVenue): self
    {
        $this->myEventVenue = $myEventVenue;

        return $this;
    }

    public function getMyEventSchedule(): ?MyEventSchedule
    {
        return $this->myEventSchedule;
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

    /**
     * Undocumented function
     *
     * @param MyEventSchedule $myEventSchedule
     * @return self
     */
    public function setMyEventSchedule(MyEventSchedule $myEventSchedule): self
    {
        $this->myEventSchedule = $myEventSchedule;
        $this->myEventSchedule->setMyEvent($this);
        return $this;
    }

     /**
     * @param User $user
     * @return bool
     */
    public function isApplied(User $user)
    {
        $schedule = $this->getMyEventSchedule();
        foreach ($schedule->getMyEventApplications() as $application)
        {
            if ($application->getUser() == $user) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        if ($this->published)  {
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getMaleSeats(): ?int
    {
        return $this->maleSeats;
    }

    public function setMaleSeats(int $maleSeats): self
    {
        $this->maleSeats = $maleSeats;

        return $this;
    }

    public function getFemaleSeats(): ?int
    {
        return $this->femaleSeats;
    }

    public function setFemaleSeats(int $femaleSeats): self
    {
        $this->femaleSeats = $femaleSeats;

        return $this;
    }

    public function getMaleAgeLower(): ?int
    {
        return $this->maleAgeLower;
    }

    public function setMaleAgeLower(int $maleAgeLower): self
    {
        $this->maleAgeLower = $maleAgeLower;

        return $this;
    }

    public function getMaleAgeUpper(): ?int
    {
        return $this->maleAgeUpper;
    }

    public function setMaleAgeUpper(int $maleAgeUpper): self
    {
        $this->maleAgeUpper = $maleAgeUpper;

        return $this;
    }

    public function getFemaleAgeLower(): ?int
    {
        return $this->femaleAgeLower;
    }

    public function setFemaleAgeLower(int $femaleAgeLower): self
    {
        $this->femaleAgeLower = $femaleAgeLower;

        return $this;
    }

    public function getFemaleAgeUpper(): ?int
    {
        return $this->femaleAgeUpper;
    }

    public function setFemaleAgeUpper(?int $femaleAgeUpper): self
    {
        $this->femaleAgeUpper = $femaleAgeUpper;

        return $this;
    }
}
