<?php

declare(strict_types=1);

namespace App\FormBuilder\Option;

use App\Entity\Football\Team;
use App\Entity\Parameter;
use App\FormBuilder\CustomOptionFormBuilder;
use App\Repository\Football\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

class EntityTypeTeamOptionFormBuilder extends CustomOptionFormBuilder
{
    const NAME = 'entity_type.football.team';

    public function __construct(FormFactoryInterface $formBuilder, private TeamRepository $teamRepository)
    {
        parent::__construct($formBuilder);
    }

    public function supports(Parameter $parameter): bool
    {
        return $parameter->getService() === self::NAME;
    }

    public function build(Parameter $parameter): FormBuilderInterface
    {
        $builder = $this->formBuilder->createNamedBuilder($parameter->getName(), EntityType::class, $parameter->getValue(), [
            'label' => 'Team',
            'class' => Team::class,
            'choice_label' => 'fullname',
            'required' => false,
            'placeholder' => 'Sélectionnez votre équipe favorite ...'
        ]);

        $builder->addModelTransformer(new CallbackTransformer(
            fn($id) => null !== $id ? $this->teamRepository->find($id) : null,
            fn(?Team $team) => $team?->getId()
        ));

        return $builder;
    }

}