<?php

namespace App\Provider\Football;

use App\Entity\Football\Team;

interface TeamProviderInterface
{
    public function getFavorite(): ?Team;
}