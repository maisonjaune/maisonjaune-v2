<?php

declare(strict_types=1);

namespace App\FormBuilder\Option;

use App\Entity\Parameter;
use App\FormBuilder\CustomOptionFormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FavoriteTeamOptionFormBuilder extends CustomOptionFormBuilder
{
    const DOMAIN = 'default';

    const NAME = 'favorite_team';

    public function supports(Parameter $parameter): bool
    {
        return $parameter->getName() === self::NAME && $parameter->getDomain() === self::DOMAIN;
    }

    public function build(Parameter $parameter): FormBuilderInterface
    {
        return $this->formBuilder->createNamedBuilder($parameter->getName(), TextType::class, $parameter->getValue(), [
            'required' => false
        ]);
    }

}