<?php

namespace App\Entity;

use App\Trait\DateTimeTrait;
use App\Repository\GroupementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupementRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Groupement
{
    use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    /**
     * @var Collection<int, AbstractMembre>
     */
    #[ORM\OneToMany(targetEntity: AbstractMembre::class, mappedBy: 'groupement')]
    private Collection $membres;

    /**
     * @var Collection<int, AbstractCampagne>
     */
    #[ORM\OneToMany(targetEntity: AbstractCampagne::class, mappedBy: 'groupement')]
    private Collection $campagnes;

    #[ORM\OneToOne(mappedBy: 'groupement', cascade: ['persist', 'remove'])]
    private ?Caisse $caisse = null;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'groupement')]
    private Collection $exercices;

    #[ORM\Column(length: 20)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->campagnes = new ArrayCollection();
        $this->exercices = new ArrayCollection();
        $this->initializeTimestamps();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, AbstractMembre>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(AbstractMembre $membre): static
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setGroupement($this);
        }

        return $this;
    }

    public function removeMembre(AbstractMembre $membre): static
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getGroupement() === $this) {
                $membre->setGroupement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AbstractCampagne>
     */
    public function getCampagnes(): Collection
    {
        return $this->campagnes;
    }

    public function addGroupement(AbstractCampagne $groupement): static
    {
        if (!$this->campagnes->contains($groupement)) {
            $this->campagnes->add($groupement);
            $groupement->setGroupement($this);
        }

        return $this;
    }

    public function removeGroupement(AbstractCampagne $groupement): static
    {
        if ($this->campagnes->removeElement($groupement)) {
            // set the owning side to null (unless already changed)
            if ($groupement->getGroupement() === $this) {
                $groupement->setGroupement(null);
            }
        }

        return $this;
    }

    public function getCaisse(): ?Caisse
    {
        return $this->caisse;
    }

    public function setCaisse(Caisse $caisse): static
    {
        // set the owning side of the relation if necessary
        if ($caisse->getGroupement() !== $this) {
            $caisse->setGroupement($this);
        }

        $this->caisse = $caisse;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
            $exercice->setGroupement($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getGroupement() === $this) {
                $exercice->setGroupement(null);
            }
        }

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }
}
