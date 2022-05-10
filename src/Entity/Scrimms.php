<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scrimms
 *
 * @ORM\Table(name="scrimms")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEq1(): ?string
    {
        return $this->nomEq1;
    }

    public function setNomEq1(string $nomEq1): self
    {
        $this->nomEq1 = $nomEq1;

        return $this;
    }

    public function getNomEq2(): ?string
    {
        return $this->nomEq2;
    }

    public function setNomEq2(string $nomEq2): self
    {
        $this->nomEq2 = $nomEq2;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


}
