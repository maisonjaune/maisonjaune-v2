<?php

declare(strict_types=1);

namespace App\FormBuilder;

use App\Entity\Parameter;
use Symfony\Component\Form\FormBuilderInterface;

interface OptionFormBuilderInterface
{
    public function build(Parameter $parameter): FormBuilderInterface;
}