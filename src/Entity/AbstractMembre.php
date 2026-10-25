<?php

namespace App\Entity;

use App\Enum\FonctionMembre;
use App\Repository\AbstractMembreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbstractMembreRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['admin' => Admin::class, 'user' => User::class])]
abstract class AbstractMembre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomC = null;

    #[ORM\Column(length: 20)]
    private ?string $tel = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $login = null;

    #[ORM\Column]
    private ?float $paiement = null;

    #[ORM\Column(enumType: FonctionMembre::class)]
    private ?FonctionMembre $fonction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomC(): ?string
    {
        return $this->nomC;
    }

    public function setNomC(string $nomC): static
    {
        $this->nomC = $nomC;

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

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPaiement(): ?float
    {
        return $this->paiement;
    }

    public function setPaiement(float $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getFonction(): ?FonctionMembre
    {
        return $this->fonction;
    }

    public function setFonction(FonctionMembre $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }
}
