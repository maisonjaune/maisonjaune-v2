<?php

namespace App\DataFixtures\Football\Game;

use App\DataFixtures\AppFixtures;
use App\Entity\Football\Game\Championship;
use Doctrine\Persistence\ObjectManager;

class ChampionshipFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        $entity = new Championship();
        $entity
            ->setName("Ligue 1 Conforama")
            ->setSlug("ligue-1");

        $manager->persist($entity);
        $this->setReference("Ligue 1 Conforama", $entity);

        $manager->flush();
    }
}