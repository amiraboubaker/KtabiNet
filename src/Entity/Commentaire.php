<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15000, nullable: true)]
    private ?string $Contenue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(nullable: true)]
    private ?float $Evaluation = null;

    #[ORM\ManyToOne]
    private ?Client $IdClient = null;

    #[ORM\ManyToOne]
    private ?LivreReel $IdLivreReel = null;

    #[ORM\ManyToOne]
    private ?LivrePdf $IdLivrePdf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenue(): ?string
    {
        return $this->Contenue;
    }

    public function setContenue(string $Contenue): static
    {
        $this->Contenue = $Contenue;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getEvaluation(): ?float
    {
        return $this->Evaluation;
    }

    public function setEvaluation(?float $Evaluation): static
    {
        $this->Evaluation = $Evaluation;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->IdClient;
    }

    public function setIdClient(?Client $IdClient): static
    {
        $this->IdClient = $IdClient;

        return $this;
    }

    public function getIdLivreReel(): ?LivreReel
    {
        return $this->IdLivreReel;
    }

    public function setIdLivreReel(?LivreReel $IdLivreReel): static
    {
        $this->IdLivreReel = $IdLivreReel;

        return $this;
    }

    public function getIdLivrePdf(): ?LivrePdf
    {
        return $this->IdLivrePdf;
    }

    public function setIdLivrePdf(?LivrePdf $IdLivrePdf): static
    {
        $this->IdLivrePdf = $IdLivrePdf;

        return $this;
    }
}
