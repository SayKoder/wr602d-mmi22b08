<?php
namespace App\Tests\Entity;

use App\Entity\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testGetterAndSetter()
    {
        // Creation d'une instance de l'entite file
        $file = new File();

        // Definition de don donnees
        $pdfname = 'comment';
	$createdAt = new \DateTimeImmutable();

        // Utilisation des setters
        $file->setPdfname($pdfname);
	$file->setCreatedAt($createdAt);

        // Verification des getters
        $this->assertEquals($pdfname, $file->getPdfname());
	$this->assertInstanceOf(\DateTimeImmutable::class, $file->getCreatedAt());
    }
}
