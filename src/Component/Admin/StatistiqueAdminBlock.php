<?php

namespace App\Component\Admin;

use App\Repository\Node\PostRepository;
use App\Repository\UserRepository;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\BlockServiceInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

class StatistiqueAdminBlock implements BlockServiceInterface
{
    public function __construct(
        private Environment    $twig,
        private UserRepository $userRepository,
        private PostRepository $postRepository,
    )
    {
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null): Response
    {
        $response->setContent($this->twig->render($blockContext->getTemplate(), [
            'data' => [
                'user' => [
                    'titre' => 'Utilisateurs',
                    'count' => $this->userRepository->countAll(),
                    'icon' => 'fa-users',
                    'bg' => 'bg-red',
                ],
                'post' => [
                    'titre' => 'Articles',
                    'count' => $this->postRepository->countAll(),
                    'icon' => 'fa-briefcase',
                    'bg' => 'bg-green',
                ],
            ],
            'block' => $blockContext->getBlock(),
            'settings' => $blockContext->getSettings()
        ]));

        return $response;
    }

    public function load(BlockInterface $block): void
    {
        // TODO: Implement load() method.
    }

    public function getCacheKeys(BlockInterface $block): array
    {
        // TODO: Implement getCacheKeys() method.
    }

    public function getName()
    {
        return 'admin-statistique-block';
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'blocks' => [
                'class' => 'col-md-3 col-sm-6 col-xs-12'
            ],
            'title' => 'Statistique',
            'template' => '@SonataBlock/Block/statistique.html.twig',
        ));
    }
}