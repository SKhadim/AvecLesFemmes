<?php

namespace App\Entity;

use App\Trait\DateTimeTrait;
use App\Repository\ModePaiementRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\UniqueConstraint(name: 'uniq_campagne_membre', columns: ['campagne_id', 'membre_id'])]
#[ORM\Entity(repositoryClass: ModePaiementRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ModePaiement
{
    use DateTimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $libre = null;

    #[ORM\ManyToOne(inversedBy: 'yes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AbstractCampagne $campagne = null;

    #[ORM\ManyToOne(inversedBy: 'yes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AbstractMembre $membre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isLibre(): ?bool
    {
        return $this->libre;
    }

    public function setLibre(bool $libre): static
    {
        $this->libre = $libre;

        return $this;
    }

    public function getCampagne(): ?AbstractCampagne
    {
        return $this->campagne;
    }

    public function setCampagne(?AbstractCampagne $campagne): static
    {
        $this->campagne = $campagne;

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
