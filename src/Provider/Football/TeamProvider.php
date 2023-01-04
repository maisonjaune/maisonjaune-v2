<?php

namespace App\Provider\Football;

use App\Entity\Football\Team;
use App\Repository\Football\TeamRepository;
use App\Storage\ParameterStorageInterface;

class TeamProvider implements TeamProviderInterface
{
    private ?Team $favoriteTeam = null;

    public function __construct(
        private ParameterStorageInterface $parameterStorage,
        private TeamRepository            $teamRepository,
    )
    {
    }

    public function getFavorite(): ?Team
    {
        $id = $this->parameterStorage->get('favorite_team');

        if (null === $this->favoriteTeam && null !== $id) {
            $this->favoriteTeam = $this->teamRepository->find($id);
        }

        return $this->favoriteTeam;
    }
}