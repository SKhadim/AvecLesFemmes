<?php

namespace App\DataFixtures;

use App\Entity\CampagneCotisation;
use App\Entity\CampagneTontine;
use App\Entity\Groupement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CampagneFixtures extends Fixture implements DependentFixtureInterface
{
    public const REF = 'campagne_';
    public const NB_CAMPAGNES = 6;

    public function load(ObjectManager $manager): void
    {
        $periodicites = ['hebdomadaire', 'mensuelle', 'trimestrielle'];
        $motifs = ['Mariage', 'Baptême', 'Achat de matériel'];

        for ($i = 0; $i < self::NB_CAMPAGNES; $i++) {
            if ($i < 3) {
                $campagne = new CampagneTontine();
                $campagne->setNom('Tontine ' . ($i + 1));
                $campagne->setNbreTours(random_int(6, 12));
                $campagne->setPeriodicite($periodicites[$i]);
            } else {
                $campagne = new CampagneCotisation();
                $campagne->setNom('Cotisation ' . ($i - 2));
                $campagne->setMotif($motifs[$i - 3]);
                $campagne->setMontantObjectif(random_int(100, 500) * 1000);
            }

            $campagne->setDateDebut(new \DateTime('-2 months'));
            $campagne->setDateFin(new \DateTime('+6 months'));
            $campagne->setMontant(random_int(1, 10) * 5000);
            $campagne->setGroupement(
                $this->getReference(GroupementFixtures::REF . ($i % 3), Groupement::class)
            );

            $manager->persist($campagne);
            $this->addReference(self::REF . $i, $campagne);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [GroupementFixtures::class];
    }
}