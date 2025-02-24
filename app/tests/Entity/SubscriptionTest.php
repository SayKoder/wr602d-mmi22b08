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
        $pdfmax = '3';
        $price = '0';
        $description = 'Le prix gratuit, profitez de 3 generation de pdf par jour max !';
	$special_price = '0';
	$special_price_from = '01-01-2024';
	$special_price_to = '10-01-2037';

        // Utilisation des setters
        $subscription->setNom($nom);
        $subscription->setPdfmax($pdfmax);
	$subscription->setPrice($price);
        $subscription->setDescription($description);
        $subscription->setSpecialprice($special_price);
	$subscription->setSpecialpricefrom($special_price);
	$subscription->setSpecialpriceto($special_price);

        // Verification des getters
        $this->assertEquals($nom, $subscription->getNom());
        $this->assertEquals($pdfmax, $subscription->getPdfmax());
	$this->assertEquals($price, $subscription->getPrice());
	$this->assertEquals($description, $subscription->getDescription());
	$this->assertEquals($special_price, $subscription->getSpecialprice());
	$this->assertEquals($special_price_from, $subscription->getSpecialpricefrom());
	$this->assertEquals($special_price_to, $subscription->getSpecialpriceto());
    }
}
