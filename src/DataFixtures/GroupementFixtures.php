<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Groupement;

class GroupementFixtures extends Fixture
{
    public const REF = 'groupement_';

    public function load(ObjectManager $manager): void
    {
        $data = [
            ['GIE Teranga Mbour', '+221 77 123 45 67', 'Mbour, Thiès'],
            ['GIE Jappo Dakar', '+221 78 234 56 78', 'Pikine, Dakar'],
            ['GIE Dëgg Saint-Louis', '+221 76 345 67 89', 'Sor, Saint-Louis'],
        ];
        foreach ($data as $key => [$nom, $tel, $adresse]) {
            // $nom = $groupement[0];
            // $tel = $groupement[1];
            // $adresse = $groupement[2];
            $groupement = (new Groupement())
                        ->setNom($nom)
                        ->setTel($tel)
                        ->setAdresse($adresse);
            $manager->persist($groupement);
            $this->addReference(self::REF . $key, $groupement);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
