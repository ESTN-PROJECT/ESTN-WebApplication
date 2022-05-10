<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank(message=" champ doit etre non vide")
     * @ORM\Column(name="nom_jeu", type="string", length=30, nullable=false)
     */
    private $nomJeu;

    /**
     * @var string
     *
     * @Assert\NotBlank(message=" champ doit etre non vide")
     * @ORM\Column(name="nom_coach", type="string", length=20, nullable=false)
     */
    private $nomCoach;

    /**
     * @var string
     *
     * @Assert\NotBlank(message=" champ doit etre non vide")
     * @ORM\Column(name="nom_membre", type="string", length=30, nullable=false)
     */
    private $nomMembre;

    /**
     * @var string
     *
     * @Assert\Length(min="8" , minMessage="Phone number must contain exactly 8 numbers")
     * @Assert\Length(max="8" , maxMessage="Phone number must contain exactly 8 numbers")

     *     )
     * @Assert\NotBlank(message=" champ doit etre non vide")
     * @ORM\Column(name="telephone", type="string", length=8, nullable=false)
     */
    private $telephone;

    /**
     * @Assert\NotBlank(message=" champ doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      minMessage=" Entrer une desc au mini de 7 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="id_event")
     */
    private $id_user;

    public function __construct()
    {
        $this->id_user = new ArrayCollection();
    }



    /**
     * @return int
     */
    public function getId(): ?int
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
    public function getNomJeu(): ?string
    {
        return $this->nomJeu;
    }

    /**
     * @param string $nomJeu
     */
    public function setNomJeu(string $nomJeu): void
    {
        $this->nomJeu = $nomJeu;
    }

    /**
     * @return string
     */
    public function getNomCoach(): ?string
    {
        return $this->nomCoach;
    }

    /**
     * @param string $nomCoach
     */
    public function setNomCoach(string $nomCoach): void
    {
        $this->nomCoach = $nomCoach;
    }

    /**
     * @return string
     */
    public function getNomMembre(): ?string
    {
        return $this->nomMembre;
    }

    /**
     * @param string $nomMembre
     */
    public function setNomMembre(string $nomMembre): void
    {
        $this->nomMembre = $nomMembre;
    }

    /**
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(Utilisateur $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
            $idUser->setIdEvent($this);
        }

        return $this;
    }

    public function removeIdUser(Utilisateur $idUser): self
    {
        if ($this->id_user->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getIdEvent() === $this) {
                $idUser->setIdEvent(null);
            }
        }

        return $this;
    }













}
