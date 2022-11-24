<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\FormBuilder\ParameterFormBuilder;
use App\Storage\ParameterStorageInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class ParameterAdminController extends CRUDController
{
    public function __construct(
        private ParameterStorageInterface $parameterStorage,
        private ParameterFormBuilder      $formBuilder)
    {
    }

    public function defaultAction(Request $request)
    {
        return $this->renderAction($request, 'default', 'Default parameters');
    }

    public function blogAction(Request $request)
    {
        return $this->renderAction($request, 'blog', 'Blog parameters');
    }

    private function renderAction(Request $request, string $domaine, string $title)
    {
        $data = $this->parameterStorage->getByDomain($domaine);

        $form = $this->formBuilder->build($data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->parameterStorage->save($domaine, $form->getData());

            $this->addFlash('success', 'Successfully saved parameters');
            return $this->redirectToRoute(sprintf('admin_app_parameter_%s', $domaine));
        }

        return $this->renderWithExtraParams('admin/CRUD/parameter/index.html.twig', [
            'title' => $title,
            'form' => $form->createView()
        ]);
    }
}