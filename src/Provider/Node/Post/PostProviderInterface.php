<?php

namespace App\Provider\Node\Post;

use App\Entity\Node\Post;

interface PostProviderInterface
{
    /**
     * @return Post[]
     */
    public function findLastSticky(): array;
}