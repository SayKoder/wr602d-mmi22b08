<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $pdfmax = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $specialPrice = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $specialPriceFrom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $specialPriceTo = null;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: "subscription")]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPdfmax(): ?int
    {
        return $this->pdfmax;
    }

    public function setPdfmax(int $pdfmax): static
    {
        $this->pdfmax = $pdfmax;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSpecialPrice(): ?float
    {
        return $this->specialPrice;
    }

    public function setSpecialPrice(?float $specialPrice): static
    {
        $this->specialPrice = $specialPrice;

        return $this;
    }

    public function getSpecialPriceFrom(): ?\DateTimeInterface
    {
        return $this->specialPriceFrom;
    }

    public function setSpecialPriceFrom(?\DateTimeInterface $specialPriceFrom): static
    {
        $this->specialPriceFrom = $specialPriceFrom;

        return $this;
    }

    public function getSpecialPriceTo(): ?\DateTimeInterface
    {
        return $this->specialPriceTo;
    }

    public function setSpecialPriceTo(?\DateTimeInterface $specialPriceTo): static
    {
        $this->specialPriceTo = $specialPriceTo;

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }
}
