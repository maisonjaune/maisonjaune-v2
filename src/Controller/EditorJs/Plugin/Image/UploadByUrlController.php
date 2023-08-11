<?php

namespace App\Controller\EditorJs\Plugin\Image;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/editorjs/plugin/image/upload-by-url', name: 'app_editorjs_plugin_image_uploadbyurl')]
class UploadByUrlController extends AbstractController
{
    public function __invoke(): Response
    {

    }
}