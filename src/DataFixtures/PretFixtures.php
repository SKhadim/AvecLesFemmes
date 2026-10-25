<?php

namespace App\DataFixtures;

use App\Entity\AbstractMembre;
use App\Entity\Caisse;
use App\Entity\Pret;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PretFixtures extends Fixture implements DependentFixtureInterface
{
    public const REF = 'pret_';
    public const MEMBRES = [0, 4, 8, 12, 16]; // membres qui empruntent

    public function load(ObjectManager $manager): void
    {
        $statuts = ['remboursé', 'accordé', 'en attente'];

        foreach (self::MEMBRES as $k => $m) {
            $pret = new Pret();
            $pret->setMontant(random_int(2, 10) * 10000);
            $pret->setDateDemande(new \DateTime('-3 months'));
            $pret->setDateEcheance(new \DateTime('+3 months'));
            $pret->setStatut($statuts[$k % 3]);
            $pret->setMembre($this->getReference(MembreFixtures::REF . $m, AbstractMembre::class));
            $pret->setCaisse($this->getReference(CaisseFixtures::REF . ($m % 3), Caisse::class));

            $manager->persist($pret);
            $this->addReference(self::REF . $k, $pret);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [MembreFixtures::class, CaisseFixtures::class];
    }
}