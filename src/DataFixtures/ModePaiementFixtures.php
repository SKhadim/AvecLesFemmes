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
        $campagnes = $manager->getRepository(AbstractCampagne::class)->findBy([], ['id' => 'ASC']);
        $membres = $manager->getRepository(AbstractMembre::class)->findBy([], ['id' => 'ASC']);

        foreach ($campagnes as $c => $campagne) {
            foreach ($membres as $m => $membre) {
                if ($m % 3 !== $c % 3) {
                    continue; // le membre est dans un autre groupement
                }

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