<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = [
            [ 'name' => 'Développement web'],
            [ 'name' => 'Développement mobile'],
            [ 'name' => 'Graphisme'],
            [ 'name' => 'Intégration'],
            [ 'name' => 'Réseau']
        ];
        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name['name']);
            $manager->persist($category);

            $manager->flush();
            //$this->addReference('category1', $category1);
            //$this->addReference('category2', $category2);
            //$this->addReference('category3', $category3);
            //$this->addReference('category4', $category4);
            //$this->addReference('category5', $category5);
        }

        $manager->flush();
    }
}
