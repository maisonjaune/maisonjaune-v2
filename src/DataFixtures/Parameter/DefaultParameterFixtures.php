<?php

namespace App\DataFixtures\Parameter;

use App\DataFixtures\AppFixtures;
use App\Entity\Parameter;
use App\FormBuilder\Option\EntityTypeTeamOptionFormBuilder;
use App\FormBuilder\Option\TextareaTypeOptionFormBuilder;
use Doctrine\Persistence\ObjectManager;

class DefaultParameterFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        $manager->persist((new Parameter())
            ->setDomain('default')
            ->setName('favorite_team')
            ->setService(EntityTypeTeamOptionFormBuilder::NAME)
            ->setValue(17)
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