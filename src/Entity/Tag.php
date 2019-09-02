<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
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
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventTag", mappedBy="tagId")
     */
    private $myEventTags;

    public function __construct()
    {
        $this->myEventTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
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
     * @return Collection|MyEventTag[]
     */
    public function getMyEventTags(): Collection
    {
        return $this->myEventTags;
    }

    public function addMyEventTag(MyEventTag $myEventTag): self
    {
        if (!$this->myEventTags->contains($myEventTag)) {
            $this->myEventTags[] = $myEventTag;
            $myEventTag->setTagId($this);
        }

        return $this;
    }

    public function removeMyEventTag(MyEventTag $myEventTag): self
    {
        if ($this->myEventTags->contains($myEventTag)) {
            $this->myEventTags->removeElement($myEventTag);
            // set the owning side to null (unless already changed)
            if ($myEventTag->getTagId() === $this) {
                $myEventTag->setTagId(null);
            }
        }

        return $this;
    }
}
