<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Factory\ActeurFactory;
use App\Factory\FilmFactory;
use App\Factory\GenreFactory;
use App\Factory\OwnerFactory;
use App\Factory\PersonneFactory;
use App\Factory\PetFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $acteurs = ActeurFactory::createMany(20);
        $genres = GenreFactory::createMany(5);
        $films = FilmFactory::createMany(50);
        $manager->flush();
    }
}
