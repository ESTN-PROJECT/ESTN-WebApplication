<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompteUtilisateur
 *
 * @ORM\Table(name="compte utilisateur")
 * @ORM\Entity
 */
class CompteUtilisateur
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
     * @ORM\Column(name="email", type="string", length=20, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=20, nullable=false)
     */
    private $password;


}
