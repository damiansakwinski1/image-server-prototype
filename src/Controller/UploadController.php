<?php

declare(strict_types=1);

namespace App\Controller;

use App\Upload\AllowedExtensionCollector;
use App\Upload\AllowedMimeTypeCollector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/image', name: 'image', methods: 'POST')]
    public function add(
        AllowedExtensionCollector $allowedExtensionCollector,
        AllowedMimeTypeCollector $allowedMimeTypeCollector
    ): Response {
        var_dump($allowedExtensionCollector->collect());
        var_dump($allowedMimeTypeCollector->collect());
        exit;

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UploadController.php',
        ]);
    }
}
