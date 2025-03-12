<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pdfname = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "files")]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPdfname(): ?string
    {
        return $this->pdfname;
    }

    public function setPdfname(string $pdfname): static
    {
        $this->pdfname = $pdfname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUsers(): Collection 
    { 
        return $this->users; 
    }

    public function addUser(User $user): static 
    { 
        if (!$this->users->contains($user)) 
        { 
            $this->users->add($user); 
        } 
        
        return $this; 
    }

    public function removeUser(User $user): static 
    { 
        $this->users->removeElement($user); 
        return $this; 
    }
}
