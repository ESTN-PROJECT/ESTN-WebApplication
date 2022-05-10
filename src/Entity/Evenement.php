<?php

namespace App\Entity;

use DateTime;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use function MongoDB\BSON\toJSON;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
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
     * @Assert\NotBlank(message="veuillez rentrez vos données")
     * @ORM\Column(name="titre_event", type="string", length=100, nullable=false)
     */
    private $titreEvent;

    /**
     * @var string
     * @Assert\NotBlank(message="veuillez rentrez vos données")
     * @ORM\Column(name="description_event", type="string", length=60, nullable=false)
     */
    private $descriptionEvent;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="veuillez rentrez vos données")
     *
     * @ORM\Column(name="date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var int
     * @ORM\Column(name="isdeleted", type="integer", nullable=false)
     */
    private $isdeleted = '0';

    /**
     * @return int
     */

    public function getIdEvent(): int
    {
        return $this->id;
    }

    /**
     * @param int $idEvent
     */
    public function setIdEvent(int $idEvent): void
    {
        $this->id = $idEvent;
    }

    /**
     * @return string
     */
    public function getTitreEvent(): ?string
    {
        return $this->titreEvent;
    }

    /**
     * @param string $titreEvent
     */
    public function setTitreEvent(string $titreEvent): void
    {
        $this->titreEvent = $titreEvent;
    }

    /**
     * @return string
     */
    public function getDescriptionEvent(): ?string
    {
        return $this->descriptionEvent;
    }

    /**
     * @param string $descriptionEvent
     */
    public function setDescriptionEvent(string $descriptionEvent): void
    {
        $this->descriptionEvent = $descriptionEvent;
    }

    /**
     * @return \DateTime
     */
    public function getDateEvent(): ?DateTime
    {
        return $this->dateEvent;
    }

    /**
     * @param \DateTime $dateEvent
     */
    public function setDateEvent(\DateTime $dateEvent): void
    {
        $this->dateEvent = $dateEvent;
    }

    /**
     * @return int
     */
    public function getIsdeleted()
    {
        return $this->isdeleted;
    }

    /**
     * @param int $isdeleted
     */
    public function setIsdeleted($isdeleted): void
    {
        $this->isdeleted = $isdeleted;
    }

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="evenements")
     */

    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function addUser(User $user): self
    {
        $this->users[] = $user;

        return $this;
    }

    public function removeUser(User $user): bool
    {
        return $this->users->removeElement($user);
    }

    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function __toString()
    {
        // Or change the property that you want to show in the select.
        return $this->titreEvent;
    }
}
