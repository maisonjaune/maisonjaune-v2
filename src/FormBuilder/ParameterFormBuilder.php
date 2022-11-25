<?php

declare(strict_types=1);

namespace App\FormBuilder;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class ParameterFormBuilder implements ParameterFormBuilderInterface
{
    public function __construct(
        private FormFactoryInterface       $formBuilder,
        private OptionFormBuilderInterface $optionFormBuilder
    )
    {
    }

    public function build(array $parameters): FormInterface
    {
        $formBuilder = $this->formBuilder->createBuilder();

        foreach ($parameters as $parameter) {
            $formBuilder->add($this->optionFormBuilder->build($parameter));
        }

        return $formBuilder->getForm();
    }
}