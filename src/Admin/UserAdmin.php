<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class UserAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('username', null, [
                'show_filter' => true
            ])
            ->add('email', null, [
                'show_filter' => true
            ])
            ->add('enabled', null, [
                'show_filter' => true
            ])
            ->add('admin', null, [
                'show_filter' => true
            ])
            ->add('lastLogin');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('admin')
            ->add('lastLogin')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Général')
                ->add('username')
                ->add('email')
                ->add('enabled')
                ->add('admin')
            ->end();
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('admin')
            ->add('enabled')
            ->add('lastLogin')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles');
    }
}
