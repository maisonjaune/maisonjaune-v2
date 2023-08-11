<?php

namespace App\Controller\EditorJs\Plugin\Image;

use App\Service\EditorJs\Response\UploadedFileResponse;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Image;

#[Route('/editorjs/plugin/image/upload-by-file', name: 'app_editorjs_plugin_image_uploadbyfile')]
class UploadByFileController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface                                                     $entityManager,
        private FormFactoryInterface                                                       $formFactory,
        #[Autowire(service: 'sonata.media.manager.media')] private MediaManagerInterface   $mediaManager,
        #[Autowire(service: 'sonata.media.provider.image')] private MediaProviderInterface $mediaProvider,
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $formBuiler = $this->formFactory->createNamedBuilder(name: '', options: [
            'csrf_protection' => false,
        ]);

        $form = $formBuiler
            ->add('image', FileType::class, [
                'constraints' => [
                    new Image(maxSize: '1024k')
                ],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('image')->getData();

            if (!$uploadedFile instanceof UploadedFile) {
                return new UploadedFileResponse(false);
            }

            $image = $this->mediaManager->create();

            $image->setBinaryContent($uploadedFile);
            $image->setContext('post');
            $image->setProviderName('sonata.media.provider.image');

            $this->mediaProvider->transform($image);
            $this->mediaManager->save($image);

            $url = $this->mediaProvider->generatePublicUrl($image, 'post_default');

            return new UploadedFileResponse($form->isSubmitted() && $form->isValid(), $url);
        }

        return new UploadedFileResponse(false);
    }
}