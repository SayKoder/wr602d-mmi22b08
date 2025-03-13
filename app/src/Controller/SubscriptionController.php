<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'app_subscription')]
    public function subscription(Request $request): Response
    {
        $form = $this->createForm(SubscriptionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $subscriptionType = $data['subscription'];

            // Sauvegarder en session ou base de données si nécessaire
            $this->addFlash('success', "Vous avez choisi l'abonnement : " . strtoupper($subscriptionType));

            return $this->redirectToRoute('/'); // Rediriger vers une autre page
        }

        return $this->render('form/subscription.html.twig', [
            'subscriptionForm' => $form->createView(),
        ]);
    }
}
