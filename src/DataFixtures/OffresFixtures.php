<?php

namespace App\DataFixtures;

use App\Entity\Contrat;
use App\Entity\Offre;
use App\Entity\TypeContrat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OffresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('en_US');

        $contrat1 = new Contrat();
        $contrat1->setType("CDD");
        $manager->persist($contrat1);
        $contrat2 = new Contrat();
        $contrat2->setType("CDI");
        $manager->persist($contrat2);
        $contrat3 = new Contrat();
        $contrat3->setType("Freelance");
        $manager->persist($contrat3);

        $typeContrat1 = new TypeContrat();
        $typeContrat1->setType("pleins");
        $manager->persist($typeContrat1);
        $typeContrat2 = new TypeContrat();
        $typeContrat2->setType("partiel");
        $manager->persist($typeContrat2);

        for ($i = 0; $i < 20; $i++) {
            $offre = new Offre();
            $offre->setTitle($faker->text($maxNbChars = 100))
                ->setDescription($faker->sentence($nbWords = 10, $variableWords = 'true'))
                ->setAdresse($faker->streetAddress())
                ->setCodePostal($faker->postcode())
                ->setVille($faker->city())
                ->setDateCreation($faker->dateTimeBetween('-6 months', '-3 months'))
                ->setDateMAJ($faker->dateTimeBetween('-3 months', 'now'))
                ->setContrat($faker->randomElement($array = array ($contrat1,$contrat2,$contrat3)))
                ->setTypeContrat($faker->randomElement($array = array ($typeContrat1,$typeContrat2)));

            if($offre->getContrat() == $contrat1 || $offre->getContrat() == $contrat3) {
                $offre->setDateFin($faker->dateTimeBetween('+6 months', '+12 months'));
            } else {
                $offre->setDateFin(null);
            }

            $manager->persist($offre);
        }

        $manager->flush();
    }
}
