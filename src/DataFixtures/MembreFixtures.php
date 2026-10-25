<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Groupement;
use App\Entity\User;
use App\Enum\FonctionMembre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MembreFixtures extends Fixture implements DependentFixtureInterface
{
    public const REF = 'membre_';
    public const NB_MEMBRES = 17; // 2 admins + 15 utilisateurs

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::NB_MEMBRES; $i++) {
            $membre = $i < 2 ? new Admin() : new User();

            $membre->setNomC($faker->name());
            $membre->setTel('77' . random_int(1000000, 9999999));
            $membre->setAdresse($faker->streetAddress());
            $membre->setLogin($faker->unique()->userName());
            $membre->setPaiement(random_int(1, 10) * 1000);
            $membre->setFonction($this->choisirFonction($i));
            $membre->setGroupement(
                $this->getReference(GroupementFixtures::REF . ($i % 3), Groupement::class)
            );

            $manager->persist($membre);
            $this->addReference(self::REF . $i, $membre);
        }

        $manager->flush();
    }

    private function choisirFonction(int $i): FonctionMembre
    {
        return match (true) {
            $i < 2 => FonctionMembre::RESPONSABLE,
            $i % 5 === 0 => FonctionMembre::SECRETAIRE,
            $i % 7 === 0 => FonctionMembre::RESPONSABLE,
            default => FonctionMembre::MEMBRE_SIMPLE,
        };
    }

    public function getDependencies(): array
    {
        return [GroupementFixtures::class];
    }
}