<?php

namespace App\DataFixtures;

use App\Entity\AbstractCampagne;
use App\Entity\AbstractMembre;
use App\Entity\ModePaiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModePaiementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($c = 0; $c < CampagneFixtures::NB_CAMPAGNES; $c++) {
            $campagne = $this->getReference(CampagneFixtures::REF . $c, AbstractCampagne::class);

            for ($m = 0; $m < MembreFixtures::NB_MEMBRES; $m++) {
                if ($m % 3 !== $c % 3) {
                    continue; // autre groupement
                }

                $membre = $this->getReference(MembreFixtures::REF . $m, AbstractMembre::class);

                $modePaiement = new ModePaiement();
                $modePaiement->setLibre(random_int(0, 1) === 1);
                $modePaiement->setCampagne($campagne);
                $modePaiement->setMembre($membre);
                $manager->persist($modePaiement);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [MembreFixtures::class, CampagneFixtures::class];
    }
}