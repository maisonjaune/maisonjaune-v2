<?php

declare(strict_types=1);

namespace App\FormBuilder;

use Symfony\Component\Form\FormInterface;

interface ParameterFormBuilderInterface
{
    public function build(array $parameters): FormInterface;
}