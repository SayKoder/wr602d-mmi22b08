<?php

namespace App\Controller;

use App\Service\PdfGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

final class PdfController extends AbstractController
{
    private PdfGeneratorService $pdfGenerator;

    public function __construct(PdfGeneratorService $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    #[Route('/generate-pdf', name: 'generate_pdf')]
    public function generatePdf(): Response
    {
        // Créer le formulaire
        $form = $this->createFormBuilder()
            ->add('url', null, ['required' => true])
            ->getForm();

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'URL saisie à partir des données du formulaire
            $url = $form->getData()['url'];

            // Faites appel à votre service pour générer le PDF
            $pdf = $this->pdfService->generatePdfFromUrl($url);

            // Rediriger ou afficher une réponse appropriée
            // Par exemple, rediriger vers une page de confirmation
            return $this->redirectToRoute('pdf_generated_success');
        }

        return $this->pdfGenerator->generatePdf($html);
    }
}
