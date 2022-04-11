<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_event", type="string", length=100, nullable=false)
     */
    private $titreEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="description_event", type="string", length=60, nullable=false)
     */
    private $descriptionEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="isdeleted", type="integer", nullable=false)
     */
    private $isdeleted = '0';

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
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

    public function getDescriptionEvent(): ?string
    {
        return $this->descriptionEvent;
    }

    public function setDescriptionEvent(string $descriptionEvent): self
    {
        $this->descriptionEvent = $descriptionEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

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
