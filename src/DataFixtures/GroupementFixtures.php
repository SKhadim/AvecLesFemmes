<?php

namespace App\DataFixtures;

use App\Entity\Groupement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupementFixtures extends Fixture
{
    public const REF = 'groupement_';

    public function load(ObjectManager $manager): void
    {
        $noms = ['Femmes Solidaires', 'Union des Femmes', 'Groupement Teranga'];

        foreach ($noms as $i => $nom) {
            $groupement = new Groupement();
            $groupement->setNom($nom);
            $manager->persist($groupement);
            $this->addReference(self::REF . $i, $groupement);
        }

        $manager->flush();
    }
}