<?php
// src/AppBundle/Entity/Admin.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventApplication", mappedBy="user")
     */
    private $myEventApplications;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserDetail", mappedBy="user", cascade={"persist", "remove"})
     */
    private $userDetail;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\BankAccount", mappedBy="user", cascade={"persist", "remove"})
     */
    private $bankAccount;

    public function __construct()
    {
        $this->setRoles(['ROLE_USER']);
        $this->myEventApplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $myEventApplication->setUser($this);
        }

        return $this;
    }

    public function removeMyEventApplication(MyEventApplication $myEventApplication): self
    {
        if ($this->myEventApplications->contains($myEventApplication)) {
            $this->myEventApplications->removeElement($myEventApplication);
            // set the owning side to null (unless already changed)
            if ($myEventApplication->getUser() === $this) {
                $myEventApplication->setUser(null);
            }
        }

        return $this;
    }

    public function getUserInit(): ?UserInit
    {
        return $this->userInit;
    }

    public function setUserInit(UserInit $userInit): self
    {
        $this->userInit = $userInit;

        // set the owning side of the relation if necessary
        if ($this !== $userInit->getUser()) {
            $userInit->setUser($this);
        }

        return $this;
    }

    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
    }

    public function setBankAccount(BankAccount $bankAccount): self
    {
        $this->bankAccount = $bankAccount;

        // set the owning side of the relation if necessary
        if ($this !== $bankAccount->getUser()) {
            $bankAccount->setUser($this);
        }

        return $this;
    }

}
