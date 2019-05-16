<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Form\Type\VichFileType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
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
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="time")
     */
    private $start_time;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\Column(type="time")
     */
    private $end_time;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="text")
     */
    private $traffic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shop_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $men_old;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $woman_old;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flow", mappedBy="myEvent", cascade={"persist"}, orphanRemoval=true)
     */
    private $flow;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="my_event_image", fileNameProperty="image", size="imageSize")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    private $imageSize;

    
    /**
     * @ORM\Column(type="integer")
     */
    private $men_remit;

    /**
     * @ORM\Column(type="integer")
     */
    private $woman_remit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Accept", mappedBy="myevent")
     */
    private $accepts;

    /**
     * @ORM\Column(type="integer")
     */
    private $men_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $woman_price;

    public function __construct()
    {
        $this->flow = new ArrayCollection();
        $this->accepts = new ArrayCollection();
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

    public function getTerms(): ?string
    {
        return $this->terms;
    }

    public function setTerms(string $terms): self
    {
        $this->terms = $terms;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): self
    {
        $this->end_time = $end_time;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTraffic(): ?string
    {
        return $this->traffic;
    }

    public function setTraffic(string $traffic): self
    {
        $this->traffic = $traffic;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getShopName(): ?string
    {
        return $this->shop_name;
    }

    public function setShopName(string $shop_name): self
    {
        $this->shop_name = $shop_name;

        return $this;
    }

    public function getMenOld(): ?string
    {
        return $this->men_old;
    }

    public function setMenOld(string $men_old): self
    {
        $this->men_old = $men_old;

        return $this;
    }

    public function getWomanOld(): ?string
    {
        return $this->woman_old;
    }

    public function setWomanOld(string $woman_old): self
    {
        $this->woman_old = $woman_old;

        return $this;
    }

    /**
     * @return Collection|Flow[]
     */
    public function getFlow(): Collection
    {
        return $this->flow;
    }

    public function addFlow(Flow $flow): self
    {
        if (!$this->flow->contains($flow)) {
            $this->flow[] = $flow;
            $flow->setMyEvent($this);
        }

        return $this;
    }

    public function removeFlow(Flow $flow): self
    {
        if ($this->flow->contains($flow)) {
            $this->flow->removeElement($flow);
            // set the owning side to null (unless already changed)
            if ($flow->getMyEvent() === $this) {
                $flow->setMyEvent(null);
            }
        }

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

    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): void
    {
        $this->image = $image;
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
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->modifiedAt = new \DateTime('now');
        }
    }
    public function getImageFile()
    {
        return $this->imageFile;
    }
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }
    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getMenRemit(): ?int
    {
        return $this->men_remit;
    }

    public function setMenRemit(int $men_remit): self
    {
        $this->men_remit = $men_remit;

        return $this;
    }

    public function getWomanRemit(): ?int
    {
        return $this->woman_remit;
    }

    public function setWomanRemit(int $woman_remit): self
    {
        $this->woman_remit = $woman_remit;

        return $this;
    }

    /**
     * @return Collection|Accept[]
     */
    public function getAccepts(): Collection
    {
        return $this->accepts;
    }

    public function addAccept(Accept $accept): self
    {
        if (!$this->accepts->contains($accept)) {
            $this->accepts[] = $accept;
            $accept->setMyevent($this);
        }

        return $this;
    }

    public function removeAccept(Accept $accept): self
    {
        if ($this->accepts->contains($accept)) {
            $this->accepts->removeElement($accept);
            // set the owning side to null (unless already changed)
            if ($accept->getMyevent() === $this) {
                $accept->setMyevent(null);
            }
        }

        return $this;
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
}
