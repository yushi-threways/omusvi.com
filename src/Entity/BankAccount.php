<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BankAccountRepository")
 */
class BankAccount
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="金融機関名を入力してください。"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     */
    private $bankName;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank(
     *     message="金融機関コードを入力してください。"
     * )
     * @Assert\Length(
     *     min = 4,
     *     max = 4,
     *     exactMessage = "{{ limit }}文字で入力してください。"
     * )
     * @Assert\Regex(pattern="/^[0-9]+$/u")
     */
    private $bankCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="支店名を入力してください。"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     */
    private $storeName;

    /**
     * @ORM\Column(type="string", length=3)
     * @Assert\NotBlank(
     *     message="支店コードを入力してください。"
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 3,
     *     exactMessage = "{{ limit }}文字で入力してください。"
     *     )
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/u",
     *     message="半角数字で入力してください。"
     * )
     */
    private $storeCode;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\NotBlank(
     *     message="種別を選択してください。"
     * )
     */
    private $bankType;

    /**
     * @ORM\Column(type="string", length=8)
     * @Assert\NotBlank(
     *     message="口座番号を入力してください。"
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/u",
     *     message="半角数字で入力してください"
     * )
     */
    private $accountNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="口座名義（カタカナ）を入力してください。"
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     * @Assert\Regex(
     *     pattern="/^[ァ-ヴー\s]+$/u",
     *     message="カタカナで入力してください。"
     * )
     */
    private $accountName;

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

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getBankCode(): ?string
    {
        return $this->bankCode;
    }

    public function setBankCode(string $bankCode): self
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    public function setStoreName(string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }

    public function getStoreCode(): ?string
    {
        return $this->storeCode;
    }

    public function setStoreCode(string $storeCode): self
    {
        $this->storeCode = $storeCode;

        return $this;
    }

    public function getBankType(): ?string
    {
        return $this->bankType;
    }

    public function setBankType(string $bankType): self
    {
        $this->bankType = $bankType;

        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(string $accountNumber): self
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }
}
