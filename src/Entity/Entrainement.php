<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrainement
 *
 * @ORM\Table(name="entrainement")
 * @ORM\Entity
 */
class Entrainement
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
     * @ORM\Column(name="nom_jeu", type="string", length=30, nullable=false)
     */
    private $nomJeu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_coach", type="string", length=20, nullable=false)
     */
    private $nomCoach;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_membre", type="string", length=30, nullable=false)
     */
    private $nomMembre;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=8, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=30, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat = '0';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJeu(): ?string
    {
        return $this->nomJeu;
    }

    public function setNomJeu(string $nomJeu): self
    {
        $this->nomJeu = $nomJeu;

        return $this;
    }

    public function getNomCoach(): ?string
    {
        return $this->nomCoach;
    }

    public function setNomCoach(string $nomCoach): self
    {
        $this->nomCoach = $nomCoach;

        return $this;
    }

    public function getNomMembre(): ?string
    {
        return $this->nomMembre;
    }

    public function setNomMembre(string $nomMembre): self
    {
        $this->nomMembre = $nomMembre;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}
