<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;

class PdfGeneratorService
{
    private HttpClientInterface $client;
    private string $gotenbergUrl;

    public function __construct(HttpClientInterface $client, string $gotenbergUrl)
    {
        $this->client = $client;
        $this->gotenbergUrl = $gotenbergUrl;
    }

    public function generatePdfFromUrl(string $html): Response
    {
        
       try {

        file_put_contents('/var/www/wr602d-mmi22b08/app/public/index.html', $html);

		$response = $this->client->request('POST', $this->gotenbergUrl . 'forms/chromium/convert/html', [
                'headers' => [	'Content-Type'=>'multipart/form-data'],    
                'body' => [

                    'index.html' => fopen('/var/www/wr602d-mmi22b08/app/public/index.html', 'r'),
                ],
            ]);


            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Error generating PDF: ' . $response->getContent());
	    }

            return new Response($response->getContent(), 200, [
                'Content-Type' => 'application/pdf',
            ]); 
    } catch (\Exception $e) {
        dd($e->getMessage());
	}
   }
}
