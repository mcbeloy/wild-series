<?php

namespace App\DataFixtures;

use App\Entity\Episodes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class Episode extends Fixture 
{
    public const EPISODES = [
        'Episode 1',
        'Episode 2',
        'Episode 3',
        'Episode 4',
        'Episode 5',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodeNumber) {
            $episode = new Episode();
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
        }
        $manager->flush();
        $this->getReference('episode_0');
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProgramFixtures::class,
        ];
    }
}
