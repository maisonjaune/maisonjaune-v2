<?php

namespace App\Service\EditorJs\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class UploadedFileResponse extends JsonResponse
{
    public function __construct(bool $success, ?string $fileurl = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct([
            'success' => $success,
            'file' => [
                'url' => $fileurl
            ]
        ], $status, $headers, $json);
    }
}