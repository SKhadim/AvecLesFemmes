<?php

namespace App\DataFixtures;

use App\Entity\Pret;
use App\Entity\Remboursement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RemboursementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (array_keys(PretFixtures::MEMBRES) as $k) {
            $pret = $this->getReference(PretFixtures::REF . $k, Pret::class);

            $nbVersements = match ($pret->getStatut()) {
                'remboursé' => 3,
                'accordé' => 1,
                default => 0,
            };

            for ($v = 1; $v <= $nbVersements; $v++) {
                $remboursement = new Remboursement();
                $remboursement->setMontant($pret->getMontant() / 3);
                $remboursement->setDateRemboursement(new \DateTime("-{$v} months"));
                $remboursement->setPret($pret);
                $manager->persist($remboursement);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PretFixtures::class];
    }
}