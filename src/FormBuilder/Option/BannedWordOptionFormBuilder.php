<?php

namespace App\FormBuilder\Option;

use App\Entity\Parameter;
use App\FormBuilder\CustomOptionFormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class BannedWordOptionFormBuilder extends CustomOptionFormBuilder
{
    const DOMAIN = 'default';

    const NAME = 'banned_word';

    public function supports(Parameter $parameter): bool
    {
        return $parameter->getName() === self::NAME && $parameter->getDomain() === self::DOMAIN;
    }

    public function build(Parameter $parameter): FormBuilderInterface
    {
        return $this->formBuilder->createNamedBuilder($parameter->getName(), TextareaType::class, $parameter->getValue(), [
            'required' => false
        ]);
    }

}