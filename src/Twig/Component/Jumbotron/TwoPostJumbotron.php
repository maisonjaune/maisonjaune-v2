<?php

namespace App\Twig\Component\Jumbotron;

use App\Entity\Node\Post;
use App\Helper\TwoPostCombination;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('two-post-jumbotron', template: '.components/jumbotrons/two-post-jumbotron.html.twig')]
class TwoPostJumbotron
{
    /**
     * @var TwoPostCombination
     */
    public TwoPostCombination $posts;

    public function hasPosts(): bool
    {
        return $this->hasPrimary() || $this->hasSecondary();
    }

    public function hasPrimary(): bool
    {
        return $this->posts->hasPrimary();
    }

    public function getPrimary(): ?Post
    {
        return $this->posts->getPrimary();
    }

    public function hasSecondary(): bool
    {
        return $this->posts->hasSecondary();
    }

    public function getSecondary(): ?Post
    {
        return $this->posts->getSecondary();
    }
}