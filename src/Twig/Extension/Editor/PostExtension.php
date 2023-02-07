<?php

namespace App\Twig\Extension\Editor;

use App\Twig\Runtime\Editor\PostRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PostExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('editor_post_data', [PostRuntime::class, 'getData'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('editor_post_data', [PostRuntime::class, 'getData'], ['is_safe' => ['html']]),
        ];
    }
}
