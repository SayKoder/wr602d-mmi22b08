<?php

namespace App\Controller;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HttpclientController extends AbstractController
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/github/profile', name: 'github_profile')]
    public function fetchGitHubProfile(): JsonResponse
    {
        $response = $this->client->request(
            'GET',
            'https://api.github.com/users/SayKoder'
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            return new JsonResponse(['error' => 'Unable to fetch GitHub profile'], $statusCode);
        }

        $content = $response->toArray();

        return new JsonResponse($content);
    }
}

