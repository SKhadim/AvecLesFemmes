<?php

namespace App\Entity;

use App\Repository\CampagneTontineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneTontineRepository::class)]
class CampagneTontine extends AbstractCampagne
{

    #[ORM\Column]
    private ?int $nbreTours = null;

    #[ORM\Column(length: 50)]
    private ?string $periodicite = null;

    public function getNbreTours(): ?int
    {
        return $this->nbreTours;
    }

    public function setNbreTours(int $nbreTours): static
    {
        $this->nbreTours = $nbreTours;
        return $this;
    }

    public function getPeriodicite(): ?string
    {
        return $this->periodicite;
    }

    public function setPeriodicite(string $periodicite): static
    {
        $this->periodicite = $periodicite;

        return $this;
    }
}
