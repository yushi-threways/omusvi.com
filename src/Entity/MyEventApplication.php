<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\DBAL\Types\MyEventApplicationPayMentEnumType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyEventApplicationRepository")
 */
class MyEventApplication
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="myEventApplications", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MyEventSchedule", inversedBy="myEventApplications")
     */
    private $myEventSchedule;

    /**
     * @var string
     * @ORM\Column(type="MyEventApplicationStatusEnumType", nullable=false)
     * @Constraints\Enum(entity="App\DBAL\Types\MyEventApplicationStatusEnumType")
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $menCount;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $womanCount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelled;

    /**
     * @var string
     * @ORM\Column(type="MyEventApplicationPayMentEnumType", nullable=false)
     * @Constraints\Enum(entity="App\DBAL\Types\MyEventApplicationPayMentEnumType")
     */
    private $paymentType;

    public function __construct()
    {
        $this->status = MyEventApplicationStatusEnumType::APPLIED;
        $this->paymentType = MyEventApplicationPayMentEnumType::BANKTRANSFER;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMyEventSchedule(): ?MyEventSchedule
    {
        return $this->myEventSchedule;
    }

    public function setMyEventSchedule(?MyEventSchedule $myEventSchedule): self
    {
        $this->myEventSchedule = $myEventSchedule;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMenCount(): ?int
    {
        return $this->menCount;
    }

    public function setMenCount(int $menCount): self
    {
        $this->menCount = $menCount;

        return $this;
    }

    public function getWomanCount(): ?int
    {
        return $this->womanCount;
    }

    public function setWomanCount(int $womanCount): self
    {
        $this->womanCount = $womanCount;

        return $this;
    }

    public function getCancelled(): ?\DateTimeInterface
    {
        return $this->cancelled;
    }

    public function setCancelled(?\DateTimeInterface $cancelled): self
    {
        $this->cancelled = $cancelled;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(?string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getEvent()
    {
        $event = $this->getMyEventSchedule()->getEvent();
        return $event;
    }

    public function isApplied(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::APPLIED;
    }
    public function isPaied(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::PAIED;
    }
    public function isAccepted(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::ACCEPTED;
    }
    public function isCanceled(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::CANCELED;
    }
    public function isRejected(): bool
    {
        return $this->status == MyEventApplicationStatusEnumType::REJECTED;
    }

    public function getStatusText($status)
    {
        switch ($status){
            case MyEventApplicationStatusEnumType::APPLIED:
                echo "申込中";
                break;
            case MyEventApplicationStatusEnumType::PAIED:
                echo "支払い確認";
                break;
            case MyEventApplicationStatusEnumType::ACCEPTED:
                echo "申込完了";
                break;
            case MyEventApplicationStatusEnumType::CANCELED:
                echo "キャンセル";
                break;
            case MyEventApplicationStatusEnumType::REJECTED:
                echo "却下済";
                break;
            default:
                echo "";
        }
    }
   
    public function isBt(): bool
    {
        return $this->paymentType == MyEventApplicationPayMentEnumType::BANKTRANSFER;
    }
    public function isLp(): bool
    {
        return $this->paymentType == MyEventApplicationPayMentEnumType::LOCALPAYMENT;
    }

    public function getPaymentText($paymentType)
    {
        switch ($paymentType){
            case MyEventApplicationPayMentEnumType::BANKTRANSFER:
                echo "銀行振込";
                break;
            case MyEventApplicationPayMentEnumType::LOCALPAYMENT:
                echo "現地払い";
                break;
            default:
                echo "";
        }
    }

    public function __toString()
    {
        return $this->getStatusText($this->status);
    }
}
