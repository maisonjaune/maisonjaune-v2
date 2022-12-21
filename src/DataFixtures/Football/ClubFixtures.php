<?php

namespace App\DataFixtures\Football;

use App\Entity\Football\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $entity = new Club();

            $entity
                ->setName($data['name']);

            $manager->persist($entity);

            $this->setReference($data['name'], $entity);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'name' => 'Amiens SC',
            ], [
                'name' => 'Angers SCO',
            ], [
                'name' => 'FC Girondins de Bordeaux',
            ], [
                'name' => 'Stade Brestois 29',
            ], [
                'name' => 'Stade Malherbe Caen',
            ], [
                'name' => 'Clermont Foot',
            ], [
                'name' => 'Dijon FCO',
            ], [
                'name' => 'En Avant Guingamp',
            ], [
                'name' => 'RC Lens',
            ], [
                'name' => 'FC Lorient',
            ], [
                'name' => 'LOSC Lille',
            ], [
                'name' => 'Olympique Lyonnais',
            ], [
                'name' => 'Olympique de Marseille',
            ], [
                'name' => 'FC Metz',
            ], [
                'name' => 'AS Monaco',
            ], [
                'name' => 'Montpellier HSC',
            ], [
                'name' => 'FC Nantes',
            ], [
                'name' => 'OGC Nice',
            ], [
                'name' => 'Nîmes Olympique',
            ], [
                'name' => 'Paris Saint-Germain',
            ], [
                'name' => 'Stade Rennais FC',
            ], [
                'name' => 'AS Saint-Étienne',
            ], [
                'name' => 'Stade de Reims',
            ], [
                'name' => 'RC Strasbourg Alsace',
            ], [
                'name' => 'Toulouse FC',
            ], [
                'name' => 'ES Troyes AC',
            ]
        ];
    }
}