<?php

namespace App\DataFixtures;

use App\Factory\JugadorFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JugadorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        JugadorFactory::createMany(5);
    }
}
