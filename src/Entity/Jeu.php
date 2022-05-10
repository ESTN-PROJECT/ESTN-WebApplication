<?php

namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu")
 * @UniqueEntity("nom")
 * @ORM\Entity
 */
class Jeu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_jeu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJeu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message=" champ doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer une categorie au mini de 2 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

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
     * @var string
     * @Assert\NotBlank(message=" please upload image")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;





    /* /**
      * @var int
      *
      * @ORM\Column(name="etat", type="integer", nullable=false)
      */
    // private $etat = '0';

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->idJeu;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->idJeu = $id;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }





    /**
     * @return string
     */
    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage( $image): void
    {
        $this->image = $image;
    }






}
