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
        $html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>My PDF</title>
  </head>
  <body>
    <h1>Guillaume le thug</h1>
  </body>
</html>';

        return $this->pdfGenerator->generatePdf($html);
    }
}
