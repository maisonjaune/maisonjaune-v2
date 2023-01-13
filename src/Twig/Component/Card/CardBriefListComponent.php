<?php

namespace App\Twig\Component\Card;

use App\Entity\Node\Category;
use App\Provider\Node\Brief\BriefProviderInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card-brief_list', template: '.components/cards/brief_list-card.html.twig')]
class CardBriefListComponent
{
    private ?Category $category = null;

    private int $count = 4;

    public array $briefs = [];

    public ?string $cardClasses = null;

    public function __construct(BriefProviderInterface $briefProvider)
    {
        $this->briefs = null !== $this->category
            ? $briefProvider->findLastByCategory($this->category)
            : $briefProvider->findLast();
    }
}
