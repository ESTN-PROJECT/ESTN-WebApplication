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

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=300, nullable=true)
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(string $nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    public function getTeamLeaderIgn(): ?string
    {
        return $this->teamLeaderIgn;
    }

    public function setTeamLeaderIgn(?string $teamLeaderIgn): self
    {
        $this->teamLeaderIgn = $teamLeaderIgn;

        return $this;
    }

    public function getPlayer2Ign(): ?string
    {
        return $this->player2Ign;
    }

    public function setPlayer2Ign(string $player2Ign): self
    {
        $this->player2Ign = $player2Ign;

        return $this;
    }

    public function getPlayer3Ign(): ?string
    {
        return $this->player3Ign;
    }

    public function setPlayer3Ign(string $player3Ign): self
    {
        $this->player3Ign = $player3Ign;

        return $this;
    }

    public function getPlayer4Ign(): ?string
    {
        return $this->player4Ign;
    }

    public function setPlayer4Ign(string $player4Ign): self
    {
        $this->player4Ign = $player4Ign;

        return $this;
    }

    public function getPlayer5Ign(): ?string
    {
        return $this->player5Ign;
    }

    public function setPlayer5Ign(string $player5Ign): self
    {
        $this->player5Ign = $player5Ign;

        return $this;
    }

    public function getJeu(): ?string
    {
        return $this->jeu;
    }

    public function setJeu(string $jeu): self
    {
        $this->jeu = $jeu;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }


}
