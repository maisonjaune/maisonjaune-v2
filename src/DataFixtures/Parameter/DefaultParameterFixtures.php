<?php

namespace App\DataFixtures\Parameter;

use App\Entity\Parameter;
use App\FormBuilder\Option\EntityTypeTeamOptionFormBuilder;
use App\FormBuilder\Option\TextareaTypeOptionFormBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DefaultParameterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $manager->persist((new Parameter())
            ->setDomain('default')
            ->setName('favorite_team')
            ->setService(EntityTypeTeamOptionFormBuilder::NAME)
            ->setValue(null)
        );

        $manager->persist((new Parameter())
            ->setDomain('default')
            ->setName('banned_word')
            ->setService(TextareaTypeOptionFormBuilder::NAME)
            ->setValue('lorem,ipsum,dolor,sit,amet')
        );

        $manager->flush();
    }
}