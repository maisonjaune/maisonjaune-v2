<?php

namespace App\Twig\Component\Card;

use App\Entity\Football\Game\Game;
use App\Entity\Football\Team;
use App\Provider\Football\TeamProviderInterface;
use App\Repository\Football\Game\GameRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-matchs', template: '.components/cards/matchs-card.html.twig')]
class CardMatchsComponent
{
    public ?Team $team = null;

    public ?string $cardClasses = null;

    public function __construct(
        private TeamProviderInterface $teamProvider,
        private GameRepository        $gameRepository,
    )
    {
    }

    public function getPreviousGame(): ?Game
    {
        return $this->gameRepository->findPreviousByTeam($this->getTeam(), new \DateTime());
    }

    public function getNextGame(): ?Game
    {
        return $this->gameRepository->findNextByTeam($this->getTeam(), new \DateTime());
    }

    public function getTeam(): ?Team
    {
        if (null === $this->team) {
            $this->team = $this->teamProvider->getFavorite();
        }

        return $this->team;
    }
}
