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
                'name' => 'Angers',
            ], [
                'name' => 'Bordeaux',
            ], [
                'name' => 'Brest',
            ], [
                'name' => 'Caen',
            ], [
                'name' => 'Clermont',
            ], [
                'name' => 'Dijon',
            ], [
                'name' => 'Guingamp',
            ], [
                'name' => 'Lens',
            ], [
                'name' => 'Lorient',
            ], [
                'name' => 'LOSC',
            ], [
                'name' => 'Lyon',
            ], [
                'name' => 'Metz',
            ], [
                'name' => 'Monaco',
            ], [
                'name' => 'Montpellier',
            ], [
                'name' => 'Nantes',
            ], [
                'name' => 'Nice',
            ], [
                'name' => 'Nîmes',
            ], [
                'name' => 'OM',
            ], [
                'name' => 'PSG',
            ], [
                'name' => 'Rennes',
            ], [
                'name' => 'St-Étienne',
            ], [
                'name' => 'Reims',
            ], [
                'name' => 'Strasbourg',
            ], [
                'name' => 'Toulouse',
            ], [
                'name' => 'Troyes',
            ]
        ];
    }
}