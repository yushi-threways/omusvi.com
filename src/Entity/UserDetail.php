<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Gender;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserDetailRepository")
 */
class UserDetail
{

    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message="姓を入力してください。"
     * )
     * @Assert\Length(
     *     max = 50,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message="名を入力してください。"
     * )
     * @Assert\Length(
     *     max = 50,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message="姓（カナ）を入力してください。"
     * )
     * @Assert\Length(
     *     max = 50,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     * @Assert\Regex(
     *      pattern="/^[ァ-ヴー\s]+$/u",
     *      match=false,
     *      message="半角ｶﾀｶﾅで入力してください。"
     * )
     */
    private $firstKana;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(
     *     message="名（カナ）を入力してください。"
     * )
     * @Assert\Length(
     *     max = 50,
     *     maxMessage = "{{ limit }}文字以内で入力してください。"
     * )
     * @Assert\Regex(
     *      pattern="/^[ァ-ヴー\s]+$/u",
     *      match=false,
     *      message="半角ｶﾀｶﾅで入力してください。"
     * )
     */
    private $lastKana;

   /**
     * @var Gender | null
     * @ORM\Column(type="GenderEnumType", nullable=true)
     * @Constraints\Enum(entity="App\DBAL\Types\GenderEnumType")
     */
    private $gender;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     *     message="電話番号を入力してください。"
     * )
     */
    private $telNumber;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(
     *     message="生年月日を入力してください。"
     * )
     */
    private $birthday;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="userDetail", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstKana(): ?string
    {
        return $this->firstKana;
    }

    public function setFirstKana(string $firstKana): self
    {
        $this->firstKana = $firstKana;

        return $this;
    }

    public function getLastKana(): ?string
    {
        return $this->lastKana;
    }

    public function setLastKana(string $lastKana): self
    {
        $this->lastKana = $lastKana;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getTelNumber(): ?string
    {
        return $this->telNumber;
    }

    public function setTelNumber(?string $telNumber): self
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
}
