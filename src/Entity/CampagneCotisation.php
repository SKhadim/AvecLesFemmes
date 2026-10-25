<?php

namespace App\Entity;

use App\Repository\CampagneCotisationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneCotisationRepository::class)]
class CampagneCotisation extends AbstractCampagne
{
    

    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column]
    private ?float $montantObjectif = null;


    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getMontantObjectif(): ?float
    {
        return $this->montantObjectif;
    }

    public function setMontantObjectif(float $montantObjectif): static
    {
        $this->montantObjectif = $montantObjectif;

        return $this;
    }
}
