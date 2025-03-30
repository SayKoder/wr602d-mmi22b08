<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\File;
use App\Service\PdfGeneratorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Security\Core\User\UserInterface;

class PdfController extends AbstractController
{
    private $pdfService;
    private $entityManager;

    public function __construct(PdfGeneratorService $pdfService, EntityManagerInterface $entityManager)
    {
        $this->pdfService = $pdfService;
        $this->entityManager = $entityManager;
    }

    #[Route('/generate-pdf', name: 'generate_pdf')]
    public function generatePdf(Request $request): Response
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté
        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour générer un PDF.");
        }

        $subscription = $user->getSubscription();
        $pdfmax = $subscription ? $subscription->getPdfmax() : 0;
        $currentPdfCount = $user->getPdfCount();

        // Créer le formulaire avec un champ URL et un bouton submit
        $form = $this->createFormBuilder()
            ->add('url', UrlType::class, [
                'required' => true,
                'label' => 'Entrez l\'URL'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Générer le PDF'
            ])
            ->getForm();

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            if ($pdfmax !== null && $currentPdfCount >= $pdfmax) {
                $this->addFlash('danger', "Vous avez atteint votre limite de génération de PDF.");
            } else {
                // Récupérer l'URL saisie
                $url = $form->getData()['url'];

                // Générer le PDF via le service
                $pdf = $this->pdfService->convertUrlToPdf($url);

                $filename = 'pdf_' . uniqid() . '.pdf';
                $filepath = $this->getParameter('pdf_directory') . '/' . $filename;

                file_put_contents($filepath, $pdf);

                // Créer une nouvelle entité File
                $file = new File();
                $file->setPdfname($filename);
                $file->setPath($filepath);
                $user->addFile($file);
                $file->addUser($user);

                $this->entityManager->persist($file);
                $this->entityManager->persist($user);
                $user->incrementPdfCount();
                $this->entityManager->flush();

                // Retourner le PDF en réponse HTTP
                return new Response($pdf, Response::HTTP_OK, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $filename . '"',
                ]);
            }
        }


        // Afficher le formulaire
        return $this->render('generate_pdf/index.html.twig', [
            'form' => $form->createView(),
            'pdfmax' => $pdfmax,
            'currentPdfCount' => $currentPdfCount,
        ]);
    }
}