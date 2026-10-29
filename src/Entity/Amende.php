<?php

namespace App\Entity;

use App\Repository\AmendeRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DateTimeTrait;
#[ORM\Entity(repositoryClass: AmendeRepository::class)]
class Amende
{
    use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbJours = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\ManyToOne(inversedBy: 'amendes')]
    private ?Seance $seance = null;

    #[ORM\ManyToOne(inversedBy: 'amendes')]
    private ?AbstractMembre $membre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    public function setNbJours(int $nbJours): static
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): static
    {
        $this->seance = $seance;

        return $this;
    }

    public function getMembre(): ?AbstractMembre
    {
        return $this->membre;
    }

    public function setMembre(?AbstractMembre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }
}
