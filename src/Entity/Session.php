<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table(name="session", indexes={@ORM\Index(name="id_membre", columns={"id_membre"})})
 * @ORM\Entity
 */
class Session
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=3, nullable=false)
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="tÃ©lÃ©phone_coach", type="integer", nullable=false)
     */
    private $tã©lã©phoneCoach;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat = '0';

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     * })
     */
    private $idMembre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTã©lã©phoneCoach(): ?int
    {
        return $this->tã©lã©phoneCoach;
    }

    public function setTã©lã©phoneCoach(int $tã©lã©phoneCoach): self
    {
        $this->tã©lã©phoneCoach = $tã©lã©phoneCoach;

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

    public function getIdMembre(): ?Utilisateur
    {
        return $this->idMembre;
    }

    public function setIdMembre(?Utilisateur $idMembre): self
    {
        $this->idMembre = $idMembre;

        return $this;
    }


}
