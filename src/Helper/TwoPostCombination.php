<?php

namespace App\Helper;

use App\Entity\Node\Post;

class TwoPostCombination
{
    private ?Post $primary;

    private ?Post $secondary;

    public function __construct(array $posts)
    {
        $posts = array_values($posts);
        $this->primary = $posts[0] ?? null;
        $this->secondary = $posts[1] ?? null;
    }

    public function hasPrimary(): bool
    {
        return null !== $this->primary;
    }

    public function getPrimary(): ?Post
    {
        return $this->primary;
    }

    public function hasSecondary(): bool
    {
        return null !== $this->secondary;
    }

    public function getSecondary(): ?Post
    {
        return $this->secondary;
    }
}