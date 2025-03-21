<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

final class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'app_subscription')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $subscriptions = $subscriptionRepository->findAll();

        return $this->render('subscription/index.html.twig', [
            'subscriptions' => $subscriptions,
        ]);
    }

    #[Route('/change-subscription/{id}', name: 'app_change_subscription', methods: ['POST'])]
    public function changeSubscription(int $id, SubscriptionRepository $subscriptionRepository, EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $subscription = $subscriptionRepository->find($id);
        if (!$subscription) {
            throw $this->createNotFoundException('Abonnement non trouvé');
        }

        $user->setSubscription($subscription);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_subscription');
    }
}
