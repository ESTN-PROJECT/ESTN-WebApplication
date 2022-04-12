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


}
