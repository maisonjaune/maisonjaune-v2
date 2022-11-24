<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Storage\ParameterStorageInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class ParameterAdminController extends CRUDController
{
    private $parameterStorage;

    public function __construct(ParameterStorageInterface $parameterStorage)
    {
        $this->parameterStorage = $parameterStorage;
    }

    public function defaultAction(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('default');

        $form = $this->createFormBuilder($data)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->parameterStorage->save('default', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirectToRoute('admin_app_parameter_global');
        }

        return $this->renderWithExtraParams('admin/CRUD/parameter/index.html.twig', [
            'title' => 'Default parameters',
            'form' => $form->createView()
        ]);
    }

    public function blogAction(Request $request)
    {
        $data = $this->parameterStorage->getByDomain('blog');

        $form = $this->createFormBuilder($data)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->parameterStorage->save('blog', $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirectToRoute('admin_app_parameter_blog');
        }

        return $this->renderWithExtraParams('admin/CRUD/parameter/index.html.twig', [
            'title' => 'Blog parameters',
            'form' => $form->createView()
        ]);
    }
}