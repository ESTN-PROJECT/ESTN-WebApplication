<?php

namespace App\Entity;
use DateTime;
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

    /**
     * @return int
     */
    public function getIdEvent(): int
    {
        return $this->idEvent;
    }

    /**
     * @param int $idEvent
     */
    public function setIdEvent(int $idEvent): void
    {
        $this->idEvent = $idEvent;
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


}
