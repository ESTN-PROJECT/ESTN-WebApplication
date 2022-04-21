<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity
 */
class Equipe
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
     * @ORM\Column(name="nom_equipe", type="string", length=20, nullable=false)
     */
    private $nomEquipe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="team_leader_ign", type="string", length=20, nullable=true)
     */
    private $teamLeaderIgn;

    /**
     * @var string
     *
     * @ORM\Column(name="player_2_ign", type="string", length=20, nullable=false)
     */
    private $player2Ign;

    /**
     * @var string
     *
     * @ORM\Column(name="player_3_ign", type="string", length=20, nullable=false)
     */
    private $player3Ign;

    /**
     * @var string
     *
     * @ORM\Column(name="player_4_ign", type="string", length=20, nullable=false)
     */
    private $player4Ign;

    /**
     * @var string
     *
     * @ORM\Column(name="player_5_ign", type="string", length=20, nullable=false)
     */
    private $player5Ign;

    /**
     * @var string
     *
     * @ORM\Column(name="jeu", type="string", length=20, nullable=false)
     */
    private $jeu;


}
