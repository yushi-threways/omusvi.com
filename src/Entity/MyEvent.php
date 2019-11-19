<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

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

    public function __construct()
    {
        $this->myEventFlows = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->setMyEventSchedule(new MyEventSchedule());

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

}
