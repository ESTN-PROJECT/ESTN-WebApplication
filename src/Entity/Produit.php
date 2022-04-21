<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Produit
 * @ORM\Table(name="produit")
 * @ORM\Entity
 *
 * @UniqueEntity("nom")
 */

class Produit
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
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un titre au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */


    private $nom;

    /**
     * @var float
     * @Assert\NotBlank(message="prix produit doit etre non vide")
     * @Assert\Positive
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 2000,
     *      minMessage = "description doit etre >=7 ",
     *      maxMessage = "description doit etre <=2000" )
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "description doit etre >=2 ",
     *      maxMessage = "description doit etre <=100" )
     * @ORM\Column(type="string", length=1000)
     */
    private $categorie;

    /**
     * @var string
     * @Assert\NotBlank(message="IMAGE  doit etre non vide")
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;





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
     * @return float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto( $photo)
    {
        $this->photo = $photo;
    }







}
