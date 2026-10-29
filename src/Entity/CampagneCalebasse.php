<?php

namespace App\Entity;

use App\Enum\PeriodiciteCalebasse;
use App\Repository\CampagneCalebasseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneCalebasseRepository::class)]
class CampagneCalebasse extends AbstractCampagne
{
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $jourRencontre = null;

    #[ORM\Column]
    private ?int $montantFixe = null;

    #[ORM\Column(nullable: true)]
    private ?int $montantCaissePresent = null;

    #[ORM\Column(nullable: true)]
    private ?int $montantCaisseAbsent = null;

    #[ORM\Column(nullable: true)]
    private ?int $amendeJournaliere = null;

    #[ORM\Column(enumType: PeriodiciteCalebasse::class)]
    private ?PeriodiciteCalebasse $periodicite = null;


    public function getJourRencontre(): ?\DateTime
    {
        return $this->jourRencontre;
    }

    public function setJourRencontre(\DateTime $jourRencontre): static
    {
        $this->jourRencontre = $jourRencontre;

        return $this;
    }

    public function getMontantFixe(): ?int
    {
        return $this->montantFixe;
    }

    public function setMontantFixe(int $montantFixe): static
    {
        $this->montantFixe = $montantFixe;

        return $this;
    }

    public function getMontantCaissePresent(): ?int
    {
        return $this->montantCaissePresent;
    }

    public function setMontantCaissePresent(?int $montantCaissePresent): static
    {
        $this->montantCaissePresent = $montantCaissePresent;

        return $this;
    }

    public function getMontantCaisseAbsent(): ?int
    {
        return $this->montantCaisseAbsent;
    }

    public function setMontantCaisseAbsent(?int $montantCaisseAbsent): static
    {
        $this->montantCaisseAbsent = $montantCaisseAbsent;

        return $this;
    }

    public function getAmendeJournaliere(): ?int
    {
        return $this->amendeJournaliere;
    }

    public function setAmendeJournaliere(?int $amendeJournaliere): static
    {
        $this->amendeJournaliere = $amendeJournaliere;

        return $this;
    }

    public function getPeriodicite(): ?PeriodiciteCalebasse
    {
        return $this->periodicite;
    }

    public function setPeriodicite(PeriodiciteCalebasse $periodicite): static
    {
        $this->periodicite = $periodicite;

        return $this;
    }
}
