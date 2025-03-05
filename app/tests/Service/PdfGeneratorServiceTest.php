<?php
// filepath: /Ubuntu/home/carl/buts6/www/wr602d-mmi22b08/tests/Service/PdfGeneratorServiceTest.php

namespace App\Tests\Service;

use App\Service\PdfGeneratorService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class PdfGeneratorServiceTest extends TestCase
{
    public function testGeneratePdfFromUrl()
    {
        $html = '<!DOCTYPE html>
		<html lang="en">
		<head> <meta charset="utf-8" /> <title>My PDF</title>
		</head> <body> <h1>Hello world!</h1> </body> </html>';
	$client = $this->createMock(HttpClientInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        // Configure the response to return a 200 status code and PDF content
        $response->method('getStatusCode')->willReturn(200);
        $response->method('getContent')->willReturn('%PDF-1.4...');

        // Configure the client to return the mocked response
        $client->method('request')->willReturn($response);

        // Create an instance of PdfGeneratorService with the mocked client
        $gotenbergUrl = 'http://gotenberg:3000/';
        $pdfGeneratorService = new PdfGeneratorService($client, $gotenbergUrl);

        // Call the method and assert the response
        $result = $pdfGeneratorService->generatePdfFromUrl($html);

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertEquals('application/pdf', $result->headers->get('Content-Type'));
        $this->assertStringStartsWith('%PDF', $result->getContent());
    }
}
