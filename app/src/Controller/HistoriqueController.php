<?php

namespace App\Controller;

use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique', name: 'historique')]
    public function index(FileRepository $fileRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour voir l'historique.");
        }

        // Récupérer les fichiers liés à l'utilisateur
        $files = $user->getFiles();
        $files->initialize();
        

        return $this->render('historique/index.html.twig', [
            'files' => $files,
        ]);
    }
}
