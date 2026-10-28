<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DateTimeTrait;
#[ORM\Entity(repositoryClass: CaisseRepository::class)]
class Caisse
{
    use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $solde = null;

    /**
     * @var Collection<int, Pret>
     */
    #[ORM\OneToMany(targetEntity: Pret::class, mappedBy: 'caisse')]
    private Collection $yes;

    #[ORM\OneToOne(inversedBy: 'caisse', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection<int, Pret>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Pret $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setCaisse($this);
        }

        return $this;
    }

    public function removeYe(Pret $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getCaisse() === $this) {
                $ye->setCaisse(null);
            }
        }

        return $this;
    }

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(Groupement $groupement): static
    {
        $this->groupement = $groupement;

        return $this;
    }
}
