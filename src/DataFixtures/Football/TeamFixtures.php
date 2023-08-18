<?php

namespace App\DataFixtures\Football;

use App\DataFixtures\AppFixtures;
use App\Entity\Football\Team;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends AppFixtures
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
                'club' => 'Angers SCO',
                'name' => 'Sénior A',
            ], [
                'club' => 'FC Girondins de Bordeaux',
                'name' => 'Sénior A',
            ], [
                'club' => 'Stade Brestois 29',
                'name' => 'Sénior A',
            ], [
                'club' => 'Stade Malherbe Caen',
                'name' => 'Sénior A',
            ], [
                'club' => 'Clermont Foot',
                'name' => 'Sénior A',
            ], [
                'club' => 'Dijon FCO',
                'name' => 'Sénior A',
            ], [
                'club' => 'En Avant Guingamp',
                'name' => 'Sénior A',
            ], [
                'club' => 'RC Lens',
                'name' => 'Sénior A',
            ], [
                'club' => 'FC Lorient',
                'name' => 'Sénior A',
            ], [
                'club' => 'LOSC Lille',
                'name' => 'Sénior A',
            ], [
                'club' => 'Olympique Lyonnais',
                'name' => 'Sénior A',
            ], [
                'club' => 'Olympique de Marseille',
                'name' => 'Sénior A',
            ], [
                'club' => 'FC Metz',
                'name' => 'Sénior A',
            ], [
                'club' => 'AS Monaco',
                'name' => 'Sénior A',
            ], [
                'club' => 'Montpellier HSC',
                'name' => 'Sénior A',
            ], [
                'club' => 'FC Nantes',
                'name' => 'Sénior A',
            ], [
                'club' => 'OGC Nice',
                'name' => 'Sénior A',
            ], [
                'club' => 'Nîmes Olympique',
                'name' => 'Sénior A',
            ], [
                'club' => 'Paris Saint-Germain',
                'name' => 'Sénior A',
            ], [
                'club' => 'Stade Rennais FC',
                'name' => 'Sénior A',
            ], [
                'club' => 'AS Saint-Étienne',
                'name' => 'Sénior A',
            ], [
                'club' => 'Stade de Reims',
                'name' => 'Sénior A',
            ], [
                'club' => 'RC Strasbourg Alsace',
                'name' => 'Sénior A',
            ], [
                'club' => 'Toulouse FC',
                'name' => 'Sénior A',
            ], [
                'club' => 'ES Troyes AC',
                'name' => 'Sénior A',
            ]
        ];
    }
}