<?php

namespace App\DataFixtures\Football;

use App\Entity\Football\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {

            if ($this->hasReference($data['club'])) {
                $entity = new Team();

                $entity
                    ->setClub($this->getReference($data['club']))
                    ->setName($data['name']);

                $manager->persist($entity);

                $this->setReference(sprintf('%s > %s', $data['club'], $data['name']), $entity);
            }
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'club' => 'Amiens SC',
                'name' => 'Sénior A',
            ], [
                'club' => 'Angers',
                'name' => 'Sénior A',
            ], [
                'club' => 'Bordeaux',
                'name' => 'Sénior A',
            ], [
                'club' => 'Brest',
                'name' => 'Sénior A',
            ], [
                'club' => 'Caen',
                'name' => 'Sénior A',
            ], [
                'club' => 'Clermont',
                'name' => 'Sénior A',
            ], [
                'club' => 'Dijon',
                'name' => 'Sénior A',
            ], [
                'club' => 'Guingamp',
                'name' => 'Sénior A',
            ], [
                'club' => 'Lens',
                'name' => 'Sénior A',
            ], [
                'club' => 'Lorient',
                'name' => 'Sénior A',
            ], [
                'club' => 'LOSC',
                'name' => 'Sénior A',
            ], [
                'club' => 'Lyon',
                'name' => 'Sénior A',
            ], [
                'club' => 'Metz',
                'name' => 'Sénior A',
            ], [
                'club' => 'Monaco',
                'name' => 'Sénior A',
            ], [
                'club' => 'Montpellier',
                'name' => 'Sénior A',
            ], [
                'club' => 'Nantes',
                'name' => 'Sénior A',
            ], [
                'club' => 'Nice',
                'name' => 'Sénior A',
            ], [
                'club' => 'Nîmes',
                'name' => 'Sénior A',
            ], [
                'club' => 'OM',
                'name' => 'Sénior A',
            ], [
                'club' => 'PSG',
                'name' => 'Sénior A',
            ], [
                'club' => 'Rennes',
                'name' => 'Sénior A',
            ], [
                'club' => 'St-Étienne',
                'name' => 'Sénior A',
            ], [
                'club' => 'Reims',
                'name' => 'Sénior A',
            ], [
                'club' => 'Strasbourg',
                'name' => 'Sénior A',
            ], [
                'club' => 'Toulouse',
                'name' => 'Sénior A',
            ], [
                'club' => 'Troyes',
                'name' => 'Sénior A',
            ]
        ];
    }
}