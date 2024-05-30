<?php

namespace App\Entity;

use App\Repository\CommandeLivreRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CommandeLivreRepository::class)]
class CommandeLivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "id_livre")]
    private ?int $id_livre = null;

    #[ORM\Column]
    private ?int $id_commande = null;
   
    #[ORM\Column]
    private ?int $Quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLivre(): ?int
    {
        return $this->id_livre;
    }

    public function setIdLivre(int $id_livre): static
    {
        $this->id_livre = $id_livre;

        return $this;
    }

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function setIdCommande(int $id_commande): static
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}