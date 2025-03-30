<?php
// tests/Entity/UserTest.php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetterAndSetter()
    {
        // Creation d'une instance de l'entite user
        $user = new User();

        // Definition de don donnees
        $email = 'test@test.com';
        $firstname = 'guillaume';
	$lastname = 'robert';
	$role = 'Gratuit';

        // Utilisation des setters
        $user->setEmail($email);
	$user->setFirstname($firstname);
	$user->setLastname($lastname);
	$user->setRole($role);

        // Verification des getters
        $this->assertEquals($email, $user->getEmail());
	$this->assertEquals($firstname, $user->getFirstname());
	$this->assertEquals($lastname, $user->getLastname());
	$this->assertEquals($role, $user->getRole());

    }
}

