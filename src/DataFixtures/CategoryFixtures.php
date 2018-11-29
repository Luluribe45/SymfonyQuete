<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    const CATEGORIES =[
        1 => 'PHP',
        2 => 'Java',
        3 => 'Javascript',
        4 => 'Ruby',
        5 => 'DevOps'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $this->addReference('categorie_' . $key, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }
}