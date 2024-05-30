<?php

namespace App\Entity;

use App\Repository\DataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRepository::class)]
class Data
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idClient = null;

    #[ORM\Column]
    private ?int $idLivre = null;

    #[ORM\Column(length: 255)]
    private ?string $categorieLivre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateConsult = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(int $idClient): static
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdLivre(): ?int
    {
        return $this->idLivre;
    }

    public function setIdLivre(int $idLivre): static
    {
        $this->idLivre = $idLivre;

        return $this;
    }

    public function getCategorieLivre(): ?string
    {
        return $this->categorieLivre;
    }

    public function setCategorieLivre(string $categorieLivre): static
    {
        $this->categorieLivre = $categorieLivre;

        return $this;
    }

    public function getDateConsult(): ?\DateTimeInterface
    {
        return $this->dateConsult;
    }

    public function setDateConsult(\DateTimeInterface $dateConsult): static
    {
        $this->dateConsult = $dateConsult;

        return $this;
    }
}
