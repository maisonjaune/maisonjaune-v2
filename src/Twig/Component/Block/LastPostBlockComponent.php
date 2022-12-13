<?php

namespace App\Twig\Component\Block;

use App\Provider\Node\Post\PostProviderInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('last_posts.block', template: '.components/blocks/last_posts.html.twig')]
class LastPostBlockComponent
{
    public array $posts = [];

    public function __construct(PostProviderInterface $postProvider)
    {
        $this->posts = $postProvider->findMain();
    }

}
