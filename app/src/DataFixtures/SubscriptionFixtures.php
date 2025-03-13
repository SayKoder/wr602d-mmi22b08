<?php
namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscriptions = [
            [
                'nom' => 'Free',
                'pdfmax' => 5,
                'price' => 0,
                'description' => "Forfait gratuit vous permettant de faire jusqu'à 5 génération de pdf maximum par jour"
            ],
            [
                'nom' => 'Premium',
                'pdfmax' => 15,
                'price' => 14.99,
                'description' => "Forfait Premium sans engagement vous permettant de faire jusque 15 génération de pdf par jour"
            ],
            [
                'nom' => 'Golden',
                'pdfmax' => 1000,
                'price' => 24.99,
                'description' => "Forfait Golden vous offrant une génération illimité de PDF pour un prix concurrent !"
            ]
        ];

        foreach ($subscriptions as $subData) {
            $subscription = new Subscription();
            $subscription->setNom($subData['nom']);
            $subscription->setPdfmax($subData['pdfmax']);
            $subscription->setPrice($subData['price']);
            $subscription->setDescription($subData['description']);
            $manager->persist($subscription);
        }

        $manager->flush();
    }
}