<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\JugadorFactory;

class JugadorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        JugadorFactory::createMany(5);
    }
}
