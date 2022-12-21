<?php

namespace App\Entity\Football\Game;

use App\Entity\Football\Team;
use App\Repository\Football\Game\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\Table(name: "football_game")]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Season $season = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamHome = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamOutside = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreHome = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreOutside = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(?\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTeamHome(): ?Team
    {
        return $this->teamHome;
    }

    public function setTeamHome(?Team $teamHome): self
    {
        $this->teamHome = $teamHome;

        return $this;
    }

    public function getTeamOutside(): ?Team
    {
        return $this->teamOutside;
    }

    public function setTeamOutside(?Team $teamOutside): self
    {
        $this->teamOutside = $teamOutside;

        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->scoreHome;
    }

    public function setScoreHome(?int $scoreHome): self
    {
        $this->scoreHome = $scoreHome;

        return $this;
    }

    public function getScoreOutside(): ?int
    {
        return $this->scoreOutside;
    }

    public function setScoreOutside(?int $scoreOutside): self
    {
        $this->scoreOutside = $scoreOutside;

        return $this;
    }
}
