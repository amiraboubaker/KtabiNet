<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommandeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Generate sample data for Commande
        for ($i = 0; $i < 100; $i++) {
            $commande = new Commande();
            $commande->setDateCommande($faker->dateTimeBetween('-1 year', 'now'));
            $commande->setPrixTotal($faker->randomNumber(4));
            $commande->setNbreLivres($faker->numberBetween(1, 10));

            // Set a random etat value (ensuring a value is present)
            $commande->setEtat($faker->randomElement(['en_attente', 'validée', 'livrée','hors_stock']));

            // Fetch sample Client entity
            $clientReference = 'client_' . rand(1, 100); // Ensure reference range aligns with ClientFixtures
            /** @var Client $client */
            $client = $this->getReference($clientReference);
            $commande->setIdClient($client);

            $manager->persist($commande);
        }

        $manager->flush();
    }
}
