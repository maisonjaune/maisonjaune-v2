<?php

namespace App\FormBuilder;

use App\Entity\Parameter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;

class ParameterFormBuilder
{
    public function __construct(
        private FormFactoryInterface $formBuilder,
    )
    {
    }

    /**
     * @param Parameter[] $parameters
     * @return \Symfony\Component\Form\FormInterface
     */
    public function build(array $parameters)
    {
        $formBuilder = $this->formBuilder->createBuilder();

        foreach ($parameters as $parameter) {
            $parameterFormBuilder = $this->formBuilder->createNamedBuilder($parameter->getName(), TextType::class, $parameter->getValue(), [
                'required' => false
            ]);

            $formBuilder->add($parameterFormBuilder);
        }

        return $formBuilder->getForm();
    }
}