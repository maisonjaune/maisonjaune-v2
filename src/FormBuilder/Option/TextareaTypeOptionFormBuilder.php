<?php

namespace App\FormBuilder\Option;

use App\Entity\Parameter;
use App\FormBuilder\CustomOptionFormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class TextareaTypeOptionFormBuilder extends CustomOptionFormBuilder
{
    const NAME = 'textarea_type';

    public function supports(Parameter $parameter): bool
    {
        return $parameter->getService() === self::NAME;
    }

    public function build(Parameter $parameter): FormBuilderInterface
    {
        return $this->formBuilder->createNamedBuilder($parameter->getName(), TextareaType::class, $parameter->getValue(), [
            'required' => false
        ]);
    }

}