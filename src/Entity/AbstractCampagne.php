<?php

namespace App\Entity;

use App\Trait\DateTimeTrait;
use App\Repository\AbstractCampagneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: AbstractCampagneRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'tontine' => CampagneTontine::class,
    'cotisation' => CampagneCotisation::class,
    'calebasse' => CampagneCalebasse::class,
])]
abstract class AbstractCampagne
{
    use DateTimeTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateFin = null;

    #[ORM\Column]
    private ?float $montant = null;

    /**
     * @var Collection<int, ModePaiement>
     */
    #[ORM\OneToMany(targetEntity: ModePaiement::class, mappedBy: 'campagne')]
    private Collection $yes;

    #[ORM\ManyToOne(inversedBy: 'abstractCampagnes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exercice = null;



    public function __construct()
    {
        $this->yes = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection<int, ModePaiement>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(ModePaiement $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setCampagne($this);
        }

        return $this;
    }

    public function removeYe(ModePaiement $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getCampagne() === $this) {
                $ye->setCampagne(null);
            }
        }

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): static
    {
        $this->exercice = $exercice;

        return $this;
    }


}
