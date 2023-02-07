<?php

namespace App\Twig\Runtime\Editor;

use App\Entity\Node\Post;
use Twig\Extension\RuntimeExtensionInterface;

class PostRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function getData(Post $post)
    {
        return json_encode([
            'title' => $post->getTitle(),
            'excerpt' => $post->getExcerpt(),
            'categories' => [],
        ]);
    }
}
