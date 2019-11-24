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

    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MyEventApplication", mappedBy="user")
     */
    private $myEventApplications;

    /**
     * @var UserDetail
     * @ORM\OneToOne(targetEntity="App\Entity\UserDetail", mappedBy="user", cascade={"persist", "remove"})
     */
    private $userDetail;

    public function __construct()
    {
        $this->myEventApplications = new ArrayCollection();
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);
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

    public function getUserDetail(): ?UserDetail
    {
        return $this->userDetail;
    }

    public function setUserDetail(UserDetail $userDetail): self
    {
        $this->userDetail = $userDetail;

        // set the owning side of the relation if necessary
        if ($this !== $userDetail->getUser()) {
            $userDetail->setUser($this);
        }

        return $this;
    }
}
