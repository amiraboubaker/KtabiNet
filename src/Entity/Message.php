<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6000)]
    private ?string $Contenue = null;

    #[ORM\Column(length: 20)]
    private ?string $Type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateHeure = null;

    #[ORM\ManyToOne]
    private ?Conversation $IdConversation = null;

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

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->DateHeure;
    }

    public function setDateHeure(\DateTimeInterface $DateHeure): static
    {
        $this->DateHeure = $DateHeure;

        return $this;
    }

    public function getIdConversation(): ?Conversation
    {
        return $this->IdConversation;
    }

    public function setIdConversation(?Conversation $IdConversation): static
    {
        $this->IdConversation = $IdConversation;

        return $this;
    }
}
