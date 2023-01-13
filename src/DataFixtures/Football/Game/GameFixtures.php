<?php

namespace App\DataFixtures\Football\Game;

use App\Entity\Football\Game\Game;
use App\Entity\Football\Game\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist((new Game())
            ->setSeason($this->getReference('Ligue 1 Conforama > Now'))
            ->setTeamHome($this->getReference('Olympique de Marseille > Sénior A'))
            ->setTeamOutside($this->getReference('FC Nantes > Sénior A'))
            ->setDate($this->date('-14 days', 20, 45))
            ->setScoreHome(random_int(0, 3))
            ->setScoreOutside(random_int(0, 3)));

        $manager->persist((new Game())
            ->setSeason($this->getReference('Ligue 1 Conforama > Now'))
            ->setTeamHome($this->getReference('FC Nantes > Sénior A'))
            ->setTeamOutside($this->getReference('OGC Nice > Sénior A'))
            ->setDate($this->date('-7 days', 21, 00))
            ->setScoreHome(random_int(0, 3))
            ->setScoreOutside(random_int(0, 3)));

        $manager->persist((new Game())
            ->setSeason($this->getReference('Ligue 1 Conforama > Now'))
            ->setTeamHome($this->getReference('Paris Saint-Germain > Sénior A'))
            ->setTeamOutside($this->getReference('FC Nantes > Sénior A'))
            ->setDate($this->date('tomorrow', 17, 00))
            ->setScoreHome(random_int(0, 3))
            ->setScoreOutside(random_int(0, 3)));

        $manager->persist((new Game())
            ->setSeason($this->getReference('Ligue 1 Conforama > Now'))
            ->setTeamHome($this->getReference('FC Nantes > Sénior A'))
            ->setTeamOutside($this->getReference('RC Lens > Sénior A'))
            ->setDate($this->date('+7 days', 21, 00))
            ->setScoreHome(random_int(0, 3))
            ->setScoreOutside(random_int(0, 3)));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }

    private function date(string $modify, int $hour, int $minute): \DateTimeImmutable
    {
        return (new \DateTimeImmutable('midnight'))
            ->modify($modify)
            ->setTime($hour, $minute);
    }
}