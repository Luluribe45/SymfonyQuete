<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            for ($n = 0; $n < 10; $n++) {
                $article = new Article();
                $article->setTitle(mb_strtolower($faker->title));
                $article->setContent($faker->text);
                $article->setCategory($this->getReference('categorie_' . $i));
                $manager->persist($article);
                $manager->flush();
            }
        }
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class,];
    }
}