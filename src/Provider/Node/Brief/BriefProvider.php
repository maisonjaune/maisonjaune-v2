<?php

namespace App\Provider\Node\Brief;

use App\Entity\Node\Category;
use App\Repository\Node\BriefRepository;

class BriefProvider implements BriefProviderInterface
{
    public function __construct(
        private BriefRepository $breveRepository,
    )
    {
    }

    public function findLast(): array
    {
        return $this->breveRepository->findLast();
    }

    public function findLastByCategory(Category $category): array
    {
        return $this->breveRepository->findLastByCategory($category);
    }
}