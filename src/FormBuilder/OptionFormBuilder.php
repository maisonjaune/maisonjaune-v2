<?php

declare(strict_types=1);

namespace App\FormBuilder;

use App\Entity\Parameter;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

class OptionFormBuilder implements OptionFormBuilderInterface
{
    public function __construct(
        #[TaggedIterator('app.admin.parameter_custom_form_builder')]
        private iterable             $customFormBuilders,
        private FormFactoryInterface $formBuilder,
    )
    {
    }

    public function build(Parameter $parameter): FormBuilderInterface
    {
        foreach ($this->customFormBuilders as $customFormBuilder) {
            if ($customFormBuilder->supports($parameter)) {
                return $customFormBuilder->build($parameter);
            }
        }

        return $this->formBuilder->createNamedBuilder($parameter->getName(), TextType::class, $parameter->getValue(), [
            'required' => false
        ]);
    }
}