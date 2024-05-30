<?php

namespace App\Entity;

use App\Repository\AccesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccesRepository::class)]
class Acces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column]
    private ?bool $Acces = null;

    #[ORM\ManyToOne]
    private ?Client $IdClient = null;

    #[ORM\ManyToOne]
    private ?LivrePdf $IdLivrePdf = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isAcces(): ?bool
    {
        return $this->Acces;
    }

    public function setAcces(bool $Acces): static
    {
        $this->Acces = $Acces;

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
