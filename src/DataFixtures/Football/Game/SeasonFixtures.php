<?php

namespace App\DataFixtures\Football\Game;

use App\DataFixtures\AppFixtures;
use App\Entity\Football\Game\Season;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends AppFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $year = date('m') > 6
            ? date('Y')
            : date('Y') - 1;

        $years = [
            'Previous' => $year - 1,
            'Now' => $year,
            'Next' => $year + 1,
        ];

        foreach ($years as $key => $value) {
            $entity = new Season();
            $entity
                ->setChampionship($this->getReference('Ligue 1 Conforama'))
                ->setName(sprintf("%d / %d", $value, $value + 1))
                ->setSlug(sprintf("%d-%d", $value, $value + 1))
                ->setYear($value);

            if ($key === 'Now') {
                $entity->setActif(true);
            }

            $this->registerTeams($entity);

            $manager->persist($entity);
            $this->setReference(sprintf("Ligue 1 Conforama > %s", $key), $entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ChampionshipFixtures::class,
        ];
    }

    private function registerTeams(Season $season)
    {
        $teams = [
            'Paris Saint-Germain',
            'Olympique Lyonnais',
            'Olympique de Marseille',
            'AS Monaco',
            'Stade Rennais FC',
            'OGC Nice',
            'Stade de Reims',
            'Montpellier HSC',
            'LOSC Lille',
            'AS Saint-Étienne',
            'FC Girondins de Bordeaux',
            'FC Nantes',
            'Angers SCO',
            'Dijon FCO',
            'Nîmes Olympique',
            'Stade Brestois 29',
            'RC Strasbourg Alsace',
            'Amiens SC',
            'Toulouse FC',
            'FC Metz',
            'ES Troyes AC',
        ];

        foreach ($teams as $team) {
            $season->addTeam($this->getReference(sprintf("%s > Sénior A", $team)));
        }
    }
}