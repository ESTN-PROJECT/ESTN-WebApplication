<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="name_user", type="string", length=100, nullable=false)
     */
    private $nameUser;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname_user", type="string", length=100, nullable=false)
     */
    private $lastnameUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_participation", type="date", nullable=false)
     */
    private $dateParticipation;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_event", type="string", length=100, nullable=false)
     */
    private $titreEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="isdeleted", type="integer", nullable=false)
     */
    private $isdeleted = '0';

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getNameUser(): ?string
    {
        return $this->nameUser;
    }

    public function setNameUser(string $nameUser): self
    {
        $this->nameUser = $nameUser;

        return $this;
    }

    public function getLastnameUser(): ?string
    {
        return $this->lastnameUser;
    }

    public function setLastnameUser(string $lastnameUser): self
    {
        $this->lastnameUser = $lastnameUser;

        return $this;
    }

    public function getDateParticipation(): ?\DateTimeInterface
    {
        return $this->dateParticipation;
    }

    public function setDateParticipation(\DateTimeInterface $dateParticipation): self
    {
        $this->dateParticipation = $dateParticipation;

        return $this;
    }

    public function getTitreEvent(): ?string
    {
        return $this->titreEvent;
    }

    public function setTitreEvent(string $titreEvent): self
    {
        $this->titreEvent = $titreEvent;

        return $this;
    }

    public function getIsdeleted(): ?int
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(int $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }


}
