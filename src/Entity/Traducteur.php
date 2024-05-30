<?php

namespace App\Entity;

use App\Repository\TraducteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraducteurRepository::class)]
class Traducteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LangueSource = null;

    #[ORM\Column(length: 255)]
    private ?string $LangueDestionation = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCompletTraducteur = null;

    #[ORM\Column(length: 255)]
    private ?string $PaysTraducteur = null;

    #[ORM\Column]
    private ?int $IdLivre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangueSource(): ?string
    {
        return $this->LangueSource;
    }

    public function setLangueSource(string $LangueSource): static
    {
        $this->LangueSource = $LangueSource;

        return $this;
    }

    public function getLangueDestionation(): ?string
    {
        return $this->LangueDestionation;
    }

    public function setLangueDestionation(string $LangueDestionation): static
    {
        $this->LangueDestionation = $LangueDestionation;

        return $this;
    }

    public function getNomCompletTraducteur(): ?string
    {
        return $this->NomCompletTraducteur;
    }

    public function setNomCompletTraducteur(string $NomCompletTraducteur): static
    {
        $this->NomCompletTraducteur = $NomCompletTraducteur;

        return $this;
    }

    public function getPaysTraducteur(): ?string
    {
        return $this->PaysTraducteur;
    }

    public function setPaysTraducteur(string $PaysTraducteur): static
    {
        $this->PaysTraducteur = $PaysTraducteur;

        return $this;
    }

    public function getIdLivre(): ?int
    {
        return $this->IdLivre;
    }

    public function setIdLivre(int $IdLivre): static
    {
        $this->IdLivre = $IdLivre;

        return $this;
    }
}
