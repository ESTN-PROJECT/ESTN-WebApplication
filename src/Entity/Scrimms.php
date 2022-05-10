<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scrimms
 *
 * @ORM\Table(name="scrimms", uniqueConstraints={@ORM\UniqueConstraint(name="nom_eq2", columns={"nom_eq2"})})
 * @ORM\Entity
 */
class Scrimms
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
     * @ORM\Column(name="nom_eq1", type="string", length=20, nullable=false)
     */
    private $nomEq1;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_eq2", type="string", length=20, nullable=false)
     */
    private $nomEq2;

    /**
     * @var string
     *
     * @ORM\Column(name="Game", type="string", length=20, nullable=false)
     */
    private $game;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomEq1(): ?string
    {
        return $this->nomEq1;
    }

    /**
     * @param string $nomEq1
     */
    public function setNomEq1(string $nomEq1): void
    {
        $this->nomEq1 = $nomEq1;
    }

    /**
     * @return string
     */
    public function getNomEq2(): ?string
    {
        return $this->nomEq2;
    }

    /**
     * @param string $nomEq2
     */
    public function setNomEq2(string $nomEq2): void
    {
        $this->nomEq2 = $nomEq2;
    }

    /**
     * @return string
     */
    public function getGame(): ?string
    {
        return $this->game;
    }

    /**
     * @param string $game
     */
    public function setGame(string $game): void
    {
        $this->game = $game;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime|null $dateDebut
     */
    public function setDateDebut(?\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime|null $dateFin
     */
    public function setDateFin(?\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }


}
