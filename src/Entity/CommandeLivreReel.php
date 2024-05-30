<?php

// src/Entity/CommandeLivreReel.php
namespace App\Entity;

use App\Repository\CommandeLivreReelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeLivreReelRepository::class)]
class CommandeLivreReel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Commande::class)]
    #[ORM\JoinColumn(name: "id_commande", referencedColumnName: "id", nullable: false)]
    private ?Commande $commande;

    #[ORM\Column]
    private ?int $idLivre;

    #[ORM\Column]
    private ?int $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getIdLivre(): ?int
    {
        return $this->idLivre;
    }

    public function setIdLivre(int $idLivre): self
    {
        $this->idLivre = $idLivre;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}