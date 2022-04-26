<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8D93D649E7927C74", columns={"email"})})
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180, nullable=false)
     * @Assert\NotBlank(message="Email is required")
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=true)
     * @Assert\NotBlank(message="Username is required")
     */
    private $username;

    /**
     * @var array|null
     *
     * @ORM\Column(name="roles", type="json", nullable=true)
     */
    private $roles = [];


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_naiss", type="date", nullable=true)
     */
    private $dateNaiss;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="City is required")
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank", type="string", length=30, nullable=true)
     * @Assert\NotBlank(message="Rank is required")
     */
    private $rank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=80, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cout", type="string", length=10, nullable=true)
     */
    private $cout;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IsDeleted", type="integer", nullable=true)
     */
    private $isdeleted;
    const ROLES = array(
        'Member' => 'ROLE_MEMBER',
        'Coach' => 'ROLE_COACH',
    );
    protected $captchaCode;

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRank(): ?string
    {
        return $this->rank;
    }

    public function setRank(?string $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCout(): ?string
    {
        return $this->cout;
    }

    public function setCout(?string $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getIsdeleted(): ?int
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(?int $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public function serialize() {
        return serialize($this->id);
    }

    public function unserialize($data) {
        $this->id = unserialize($data);
    }
}
