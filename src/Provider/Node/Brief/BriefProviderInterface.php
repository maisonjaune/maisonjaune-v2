<?php

namespace App\Provider\Node\Brief;

use App\Entity\Node\Category;
use App\Entity\Node\Post;

interface BriefProviderInterface
{
    /**
     * @return Post[]
     */
    public function findLast(): array;

    /**
     * @return Post[]
     */
    public function findLastByCategory(Category $category): array;
}