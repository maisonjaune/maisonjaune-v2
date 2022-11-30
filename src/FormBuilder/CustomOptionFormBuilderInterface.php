<?php

declare(strict_types=1);

namespace App\FormBuilder;

use App\Entity\Parameter;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\Form\FormBuilderInterface;

#[Autoconfigure(tags: ['app.admin.parameter_custom_form_builder'])]
interface CustomOptionFormBuilderInterface
{
    public function supports(Parameter $parameter): bool;

    public function build(Parameter $parameter): FormBuilderInterface;
}