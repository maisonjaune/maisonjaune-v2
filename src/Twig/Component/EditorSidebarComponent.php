<?php

namespace App\Twig\Component;

use Symfony\Component\Form\FormView;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('editor-sidebar', template: '.components/editor/sidebar.html.twig')]
class EditorSidebarComponent
{
    public FormView $form;
}
