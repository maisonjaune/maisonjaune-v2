<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Route\RouteCollectionInterface;

final class ParameterAdmin extends AbstractAdmin
{
    protected $accessMapping = [
        'default' => 'DEFAULT',
        'blog' => 'BLOG'
    ];

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->clear();
        $collection->add('default', 'default');
        $collection->add('blog', 'blog');
    }
}