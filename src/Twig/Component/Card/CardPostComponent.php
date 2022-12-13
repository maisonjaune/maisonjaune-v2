<?php

namespace App\Twig\Component\Card;

use App\Entity\Node\Post;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-post', template: '.components/cards/post-card.html.twig')]
class CardPostComponent
{
    public Post $post;

    public string $mediaFormat;
}