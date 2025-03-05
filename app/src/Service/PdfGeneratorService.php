<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;

class PdfGeneratorService
{
    private HttpClientInterface $httpClient;
    private string $gotenbergUrl;

    public function __construct(HttpClientInterface $httpClient, string $gotenbergUrl)
    {
        $this->httpClient = $httpClient;
        $this->gotenbergUrl = $gotenbergUrl;
    }

    public function generatePdf(string $htmlContent): Response
    {
    
        file_put_contents('/var/www/wr602d-mmi22b08/app/public/index.html', $htmlContent);

    $response = $this->httpClient->request('POST', $this->gotenbergUrl . 'forms/chromium/convert/html', [
            'headers' => [
                'Content-Type' => 'multipart/form-data'
            ],
            'body' => [
                'files' => [
                    'index.html' => fopen('/var/www/wr602d-mmi22b08/app/public/index.html', 'r')
                ]
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erreur lors de la generation du PDF: ' . $response->getContent());
        }

        return new Response($response->getContent(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }
}
