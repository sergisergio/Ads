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
            'Développement web',
            'Développement mobile',
            'Graphisme',
            'Intégration',
            'Réseau'
        ];
        foreach ($names as $name) {
            $category1 = new Category();
            $category1->setName('Développement web');
            $manager->persist($category1);
            $category2 = new Category();
            $category2->setName('Développement mobile');
            $manager->persist($category2);
            $category3 = new Category();
            $category3->setName('Graphisme');
            $manager->persist($category3);
            $category4 = new Category();
            $category4->setName('Intégration');
            $manager->persist($category4);
            $category5 = new Category();
            $category5->setName('Réseau');
            $manager->persist($category5);

            $manager->flush();
            $this->addReference('category1', $category1);
            $this->addReference('category2', $category2);
            $this->addReference('category3', $category3);
            $this->addReference('category4', $category4);
            $this->addReference('category5', $category5);
        }

        $manager->flush();
    }
}
