<?php

namespace App\Entity;

use App\Repository\LivrePdfRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivrePdfRepository::class)]
class LivrePdf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $Auteur = null;

    #[ORM\Column]
    private ?float $Prix = null;

    #[ORM\Column(length: 2500)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Categorie = null;

    #[ORM\Column]
    private ?int $NbrPage = null;

    #[ORM\Column]
    private ?float $Solde = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DatePublication = null;

    #[ORM\Column(length: 255)]
    private ?string $langue = null;

    #[ORM\Column(length: 255)]
    private ?string $UrlPdf = null;

    #[ORM\Column(length: 255)]
    private ?string $UrlImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    // Dans votre entité LivrePdf
    public function __toString()
    {
        return (string) $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): static
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getNbrPage(): ?int
    {
        return $this->NbrPage;
    }

    public function setNbrPage(int $NbrPage): static
    {
        $this->NbrPage = $NbrPage;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->Solde;
    }

    public function setSolde(float $Solde): static
    {
        $this->Solde = $Solde;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->DatePublication;
    }

    public function setDatePublication(\DateTimeInterface $DatePublication): static
    {
        $this->DatePublication = $DatePublication;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getUrlPdf(): ?string
    {
        return $this->UrlPdf;
    }

    public function setUrlPdf(string $UrlPdf): static
    {
        $this->UrlPdf = $UrlPdf;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->UrlImage;
    }

    public function setUrlImage(string $UrlImage): static
    {
        $this->UrlImage = $UrlImage;

        return $this;
    }
}
