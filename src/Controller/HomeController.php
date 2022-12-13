<?php

namespace App\Controller;

use App\Helper\TwoPostCombination;
use App\Provider\Node\Post\PostProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_home')]
class HomeController extends AbstractController
{
    public function __invoke(PostProviderInterface $postProvider): Response
    {
        return $this->render('home/index.html.twig', [
            'postCombination' => new TwoPostCombination($postProvider->findLastSticky()),
        ]);
    }
}
