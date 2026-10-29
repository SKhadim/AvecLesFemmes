<?php

namespace App\Entity;

use App\Enum\PresenceMembre;
use App\Repository\CotisationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DateTimeTrait;
#[ORM\Entity(repositoryClass: CotisationRepository::class)]
#[ORM\UniqueConstraint(name: 'uniq_seance_membre', columns: ['seance_id', 'membre_id'])]
class Cotisation
{
    use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $montantEpargne = null;

    #[ORM\Column]
    private ?int $montantCaisse = null;

    #[ORM\Column(enumType: PresenceMembre::class)]
    private ?PresenceMembre $presence = null;

    #[ORM\ManyToOne(inversedBy: 'cotisations')]
    private ?Seance $seance = null;

    #[ORM\ManyToOne(inversedBy: 'cotisations')]
    private ?AbstractMembre $membre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantEpargne(): ?int
    {
        return $this->montantEpargne;
    }

    public function setMontantEpargne(int $montantEpargne): static
    {
        $this->montantEpargne = $montantEpargne;

        return $this;
    }

    public function getMontantCaisse(): ?int
    {
        return $this->montantCaisse;
    }

    public function setMontantCaisse(int $montantCaisse): static
    {
        $this->montantCaisse = $montantCaisse;

        return $this;
    }

    public function getPresence(): ?PresenceMembre
    {
        return $this->presence;
    }

    public function setPresence(PresenceMembre $presence): static
    {
        $this->presence = $presence;

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
