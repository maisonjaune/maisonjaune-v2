<?php

declare(strict_types=1);

namespace App\FormBuilder;

use Symfony\Component\Form\FormFactoryInterface;

abstract class CustomOptionFormBuilder implements CustomOptionFormBuilderInterface
{
    public function __construct(
        protected FormFactoryInterface $formBuilder,
    )
    {
    }
}