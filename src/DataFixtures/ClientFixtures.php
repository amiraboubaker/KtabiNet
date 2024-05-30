<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Generate 100 clients with unique emails and references
        // Generate 100 clients with unique emails and references
        for ($i = 1; $i <= 100; $i++) {
            $client = new Client();
            $client->setEmail($faker->unique()->email());
            $client->setNomClient($faker->lastName());
            $client->setPrenomClient($faker->firstName());
            $client->setNumTel($faker->phoneNumber());
            $client->setAdress("Tunisie/Monastir");
            $client->setPassword(password_hash('1234', PASSWORD_BCRYPT));
            $randomRole = mt_rand(0, 1) === 0 ? 'ROLE_ADMIN' : 'ROLE_USER';
            $client->setRoles([$randomRole]);
            $manager->persist($client);

            // Assign reference name with current loop iteration
            $this->addReference("client_$i", $client);
        }
        $manager->flush();
    }
}
