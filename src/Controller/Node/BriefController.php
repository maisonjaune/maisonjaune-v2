<?php

namespace App\Controller\Node;

use App\Entity\Node\Brief;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/brief/{slug}', name: 'app_node_brief')]
class BriefController extends AbstractController
{
    public function __invoke(Request $request, Brief $brief): Response
    {
        return $this->render('node/brief/index.html.twig', [
            'brief' => $brief,
        ]);
    }
}
