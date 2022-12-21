<?php

namespace App\Controller\Node;

use App\Entity\Node\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post/{slug}', name: 'app_node_post')]
class PostController extends AbstractController
{
    public function __invoke(Post $post): Response
    {
        return $this->render('node/post/show/classic.html.twig', [
            'post' => $post,
        ]);
    }
}
