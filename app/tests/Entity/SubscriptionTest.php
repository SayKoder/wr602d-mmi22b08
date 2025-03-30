<?php 
use App\Entity\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testGetterAndSetter()
    {
        // Creation d'une instance de l'entite user
        $subscription = new Subscription();

        // Definition de don donnees
        $nom = 'Gratuit';
        $pdfmax = 3;
        $price = 0.0;
        $description = 'Le prix gratuit, profitez de 3 generation de pdf par jour max !';
	$specialPrice = 0.0;
	$specialPriceFrom = new \DateTime('01-01-2024');
	$specialPriceTo = new \DateTime('10-01-2037');

        // Utilisation des setters
        $subscription->setNom($nom);
        $subscription->setPdfmax($pdfmax);
	$subscription->setPrice($price);
        $subscription->setDescription($description);
        $subscription->setSpecialprice($specialPrice);
	$subscription->setSpecialpriceFrom($specialPriceFrom);
	$subscription->setSpecialpriceTo($specialPriceTo);

        // Verification des getters
        $this->assertEquals($nom, $subscription->getNom());
        $this->assertEquals($pdfmax, $subscription->getPdfmax());
	$this->assertEquals($price, $subscription->getPrice());
	$this->assertEquals($description, $subscription->getDescription());
	$this->assertEquals($specialPrice, $subscription->getSpecialPrice());
	$this->assertEquals($specialPriceFrom, $subscription->getSpecialPriceFrom());
	$this->assertEquals($specialPriceTo, $subscription->getSpecialPriceTo());
    }
}
