<?php

declare(strict_types=1);

namespace App\Admin\Node;

use App\Entity\Media\Media;
use App\Entity\Node\Post;
use App\Workflow\Place\PostTransition;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DateTimePickerType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Workflow\WorkflowInterface;

final class PostAdmin extends AbstractAdmin
{
    public const PERMISSION_REVIEW = 'REVIEW';

    public const PERMISSION_DECORATE = 'DECORATE';

    public const PERMISSION_PUBLISH = 'PUBLISH';

    public const PERMISSION_UNPUBLISH = 'UNPUBLISH';

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection
            ->add('review', $this->getRouterIdParameter() . '/review')
            ->add('decorate', $this->getRouterIdParameter() . '/decorate')
            ->add('publish', $this->getRouterIdParameter() . '/publish')
            ->add('unpublish', $this->getRouterIdParameter() . '/unpublish');
    }

    protected function getAccessMapping(): array
    {
        return [
            'review' => self::PERMISSION_REVIEW,
            'decorate' => self::PERMISSION_DECORATE,
            'publish' => self::PERMISSION_PUBLISH,
            'unpublish' => self::PERMISSION_UNPUBLISH,
        ];
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('title', null, [
                'show_filter' => true
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('title')
            ->add('publishedAt')
            ->add('actif')
            ->add('draft')
            ->add('sticky')
            ->add('commentable')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'edit' => [
                        'workflow' => PostTransition::WRITE
                    ],
                    'review' => [
                        'workflow' => PostTransition::REVIEW
                    ],
                    'decorate' => [
                        'workflow' => PostTransition::DECORATE
                    ],
                    'publish' => [
                        'workflow' => PostTransition::PUBLISH
                    ],
                    'unpublish' => [
                        'workflow' => PostTransition::UNPUBLISH
                    ],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Content', ['box_class' => 'box box-primary', 'class' => 'col-md-8'])
            ->add('title')
            ->add('slug')
            ->add('image', MediaType::class, [
                'data_class' => Media::class,
                'provider' => 'sonata.media.provider.image',
                'context' => 'post',
            ])
            ->add('excerpt')
            ->add('content')
            ->end()
            ->with('Additional information', ['box_class' => 'box box-default', 'class' => 'col-md-4'])
            ->add('publishedAt', DateTimePickerType::class)
            ->add('actif')
            ->add('draft')
            ->add('sticky')
            ->add('commentable')
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('title')
            ->add('slug')
            ->add('content')
            ->add('publishedAt')
            ->add('actif')
            ->add('draft')
            ->add('sticky')
            ->add('commentable')
            ->add('excerpt');
    }

    public function toString(object $object): string
    {
        return $object instanceof Post
            ? $object->getTitle()
            : '';
    }
}
