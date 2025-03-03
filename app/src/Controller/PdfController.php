<?php

namespace App\Controller;

use App\Service\PdfGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
        $htmlContent = '<h1>Mon PDF</h1><p>Ceci est un test</p>';

        return $this->pdfGenerator->generatePdf($htmlContent);
    }
}
