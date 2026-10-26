<?php


namespace App\DataFixtures;

use App\Entity\Caisse;
use App\Entity\Groupement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CaisseFixtures extends Fixture implements DependentFixtureInterface
{
    public const REF = 'caisse_';

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $caisse = new Caisse();
            $caisse->setSolde(random_int(100000, 500000));
            $caisse->setGroupement($this->getReference(GroupementFixtures::REF . $i, Groupement::class));
            $manager->persist($caisse);
            $this->addReference(self::REF . $i, $caisse); // ligne ajoutée
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [GroupementFixtures::class];
    }
    // ...
}