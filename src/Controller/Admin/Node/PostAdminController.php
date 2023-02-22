<?php

declare(strict_types=1);

namespace App\Controller\Admin\Node;

use App\Entity\Node\Post;
use App\Enum\Node\FormPostType;
use App\Form\Node\PostType;
use App\Workflow\Place\PostTransition;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Exception\LockException;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Sonata\AdminBundle\Exception\ModelManagerThrowable;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Workflow\WorkflowInterface;

final class PostAdminController extends CRUDController
{
    public function __construct(private WorkflowInterface $postWorkflow)
    {
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return Response|null
     */
    protected function preCreate(Request $request, object $post): ?Response
    {
        $form = $this->createForm(PostType::class, $post, [
            'form_type' => FormPostType::TYPE_CREATE
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO check post type with `$request->get('btn_create_post')`

            try {
                $this->admin->create($post);
            } catch (ModelManagerException $e) {
                $this->handleModelManagerException($e);
            } catch (ModelManagerThrowable $e) {
                $this->addFlash('sonata_flash_error',  $this->handleModelManagerThrowable($e) ?? $this->trans('flash_create_error', [
                    '%name%' => $this->escapeHtml($this->admin->toString($post))
                ], 'SonataAdminBundle'));
            }

            return $this->redirectTo($request, $post);
        }

        $formView = $form->createView();

        $this->setFormTheme($formView, $this->admin->getFormTheme());

        $this->admin->setSubject($post);

        return $this->renderWithExtraParams('@SonataAdmin/CRUD/node/post/create.html.twig', [
            'action' => 'create',
            'form' => $formView,
            'object' => $post,
            'objectId' => null,
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return Response|null
     */
    protected function preEdit(Request $request, object $post): ?Response
    {
        if (!$this->postWorkflow->can($post, PostTransition::WRITE->value)) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(PostType::class, $post, [
            'form_type' => FormPostType::TYPE_WRITE
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if (null !== $request->get('btn_update_and_list')) {
                    $post->setDraft(false);
                }

                $this->admin->update($post);

                return $this->redirectTo($request, $post);
            } catch (LockException $e) {
                // TODO handle lock exception
            } catch (ModelManagerThrowable $e) {
                // TODO handle model manager throwable
            }
        }

        return $this->renderWithExtraParams('@SonataAdmin/CRUD/node/post/edit.html.twig', [
            'action' => 'edit',
            'object' => $post,
            'form' => $form->createView(),
        ]);
    }

    protected function reviewAction(int $id): ?Response
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        $this->addFlash('sonata_flash_success', 'Examined successfully');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }

    protected function imageAction(int $id): ?Response
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        $this->addFlash('sonata_flash_success', 'Image added successfully');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}
