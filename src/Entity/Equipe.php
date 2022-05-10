<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @var
     * @Assert\NotBlank(message=" Nom doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un nom au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(name="nom_equipe", type="string", length=20, nullable=true)
     */
    private $nomEquipe;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Team Leader doit etre non vide")
     * @ORM\Column(name="team_leader_ign", type="string", length=30, nullable=false)
     */
    private $teamLeaderIgn;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Team Leader doit etre non vide")
     * @ORM\Column(name="player_2_ign", type="string", length=30, nullable=false)
     */
    private $player2Ign;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Team Leader doit etre non vide")
     * @ORM\Column(name="player_3_ign", type="string", length=30, nullable=false)
     */
    private $player3Ign;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Team Leader doit etre non vide")
     * @ORM\Column(name="player_4_ign", type="string", length=30, nullable=false)
     */
    private $player4Ign;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Team Leader doit etre non vide")
     * @ORM\Column(name="player_5_ign", type="string", length=30, nullable=false)
     */
    private $player5Ign;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Team Leader doit etre non vide")
     * @ORM\Column(name="jeu", type="string", length=30, nullable=false)
     */
    private $jeu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=300, nullable=true)
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
     * @return string|null
     */
    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    /**
     * @param string|null $nomEquipe
     */
    public function setNomEquipe(?string $nomEquipe): void
    {
        $this->nomEquipe = $nomEquipe;
    }

    /**
     * @return string
     */
    public function getTeamLeaderIgn(): ?string
    {
        return $this->teamLeaderIgn;
    }

    /**
     * @param string $teamLeaderIgn
     */
    public function setTeamLeaderIgn(string $teamLeaderIgn): void
    {
        $this->teamLeaderIgn = $teamLeaderIgn;
    }

    /**
     * @return string
     */
    public function getPlayer2Ign(): ?string
    {
        return $this->player2Ign;
    }

    /**
     * @param string $player2Ign
     */
    public function setPlayer2Ign(string $player2Ign): void
    {
        $this->player2Ign = $player2Ign;
    }

    /**
     * @return string
     */
    public function getPlayer3Ign(): ?string
    {
        return $this->player3Ign;
    }

    /**
     * @param string $player3Ign
     */
    public function setPlayer3Ign(string $player3Ign): void
    {
        $this->player3Ign = $player3Ign;
    }

    /**
     * @return string
     */
    public function getPlayer4Ign(): ?string
    {
        return $this->player4Ign;
    }

    /**
     * @param string $player4Ign
     */
    public function setPlayer4Ign(string $player4Ign): void
    {
        $this->player4Ign = $player4Ign;
    }

    /**
     * @return string
     */
    public function getPlayer5Ign(): ?string
    {
        return $this->player5Ign;
    }

    /**
     * @param string $player5Ign
     */
    public function setPlayer5Ign(string $player5Ign): void
    {
        $this->player5Ign = $player5Ign;
    }

    /**
     * @return string
     */
    public function getJeu(): ?string
    {
        return $this->jeu;
    }

    /**
     * @param string $jeu
     */
    public function setJeu(string $jeu): void
    {
        $this->jeu = $jeu;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }


}
