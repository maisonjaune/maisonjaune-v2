<?php

namespace App\Component\Admin;

use App\Service\ServerInformations\ServerInformationsProviderInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\BlockServiceInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

class ServerStatistiqueAdminBlock implements BlockServiceInterface
{
    public function __construct(
        private Environment                         $twig,
        private ServerInformationsProviderInterface $serverInformationsProvider
    )
    {
    }

    public function execute(BlockContextInterface $blockContext, ?Response $response = null): Response
    {
        $settings = $blockContext->getSettings();

        return new Response($this->twig->render($blockContext->getTemplate(), [
            'block' => $blockContext->getBlock(),
            'settings' => $settings,
            'data' => [
                'disk_available_space' => $this->serverInformationsProvider->getAvailableSpace(),
                'disk_total_space' => $this->serverInformationsProvider->getTotalSpace(),
                'percent_available_space' => $this->serverInformationsProvider->getPercentAvailableSpace(),
                'progressbar_background_color' => $this->getProgressbarBackgroundColor(),
                'database_used_space' => $this->serverInformationsProvider->getDatabaseUsedSpace(),
            ],
        ]));
    }

    public function load(BlockInterface $block): void
    {
        // TODO: Implement load() method.
    }

    public function getCacheKeys(BlockInterface $block): array
    {
        // TODO: Implement getCacheKeys() method.
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'title' => 'Statistique serveur',
            'template' => '@SonataBlock/Block/server.html.twig',
        ]);
    }

    private function getProgressbarBackgroundColor()
    {
        if ($this->serverInformationsProvider->getPercentAvailableSpace() > 90) {
            return 'progress-bar-danger';
        }

        if ($this->serverInformationsProvider->getPercentAvailableSpace() > 70) {
            return 'progress-bar-warning';
        }

        return 'progress-bar-info';
    }
}
