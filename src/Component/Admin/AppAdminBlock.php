<?php

namespace App\Component\Admin;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\BlockServiceInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

class AppAdminBlock implements BlockServiceInterface
{
    public function __construct(private Environment $twig)
    {
    }

    public function execute(BlockContextInterface $blockContext, ?Response $response = null): Response
    {
        $maintenanceExpired = $this->isExpired(Kernel::END_OF_MAINTENANCE);
        $lifeExpired = $this->isExpired(Kernel::END_OF_LIFE);

        $response->setContent($this->twig->render($blockContext->getTemplate(), [
            'box_class' => $lifeExpired ? 'box-danger' : ($maintenanceExpired ? 'box-warning' : ''),
            'maintenanceExpired' => $maintenanceExpired,
            'lifeExpired' => $lifeExpired,
            'data' => [
                'PHP' => PHP_VERSION,
                'Symfony' => Kernel::VERSION,
                'End of maintenance' => Kernel::END_OF_MAINTENANCE,
                'End of life' => Kernel::END_OF_LIFE,
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
        return 'admin-server-block';
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'blocks' => [
                'class' => 'col-md-3 col-sm-6 col-xs-12'
            ],
            'title' => 'Statistique',
            'template' => '@SonataBlock/Block/app.html.twig',
        ));
    }

    private function isExpired(string $date): bool
    {
        $date = \DateTime::createFromFormat('d/m/Y', '01/'.$date);

        return false !== $date
            && new \DateTime() > $date->modify('last day of this month 23:59:59');
    }
}
