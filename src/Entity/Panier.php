<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity
 */
class Panier
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
     * @var int
     *
     * @ORM\Column(name="nbr_prod", type="integer", nullable=false)
     */
    private $nbrProd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrProd(): ?int
    {
        return $this->nbrProd;
    }

    public function setNbrProd(int $nbrProd): self
    {
        $this->nbrProd = $nbrProd;

        return $this;
    }


}
