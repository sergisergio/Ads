<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AdvertFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $names = [
            ['title' => 'Recherche développeur Symfony', 'date' => new \Datetime()],
            ['title' => 'Mission de webmaster', 'date' => new \Datetime()],
            ['title' => 'Offre de stage webdesigner', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony/Angular', 'date' => new \Datetime()],
            ['title' => 'Mission de graphiste', 'date' => new \Datetime()],
            ['title' => 'Offre de stage développeur Javascript', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony', 'date' => new \Datetime()],
            ['title' => 'Mission de webmaster', 'date' => new \Datetime()],
            ['title' => 'Offre de stage webdesigner', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony/Angular', 'date' => new \Datetime()],
            ['title' => 'Mission de graphiste', 'date' => new \Datetime()],
            ['title' => 'Offre de stage développeur Javascript', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony', 'date' => new \Datetime()],
            ['title' => 'Mission de webmaster', 'date' => new \Datetime()],
            ['title' => 'Offre de stage webdesigner', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony/Angular', 'date' => new \Datetime()],
            ['title' => 'Mission de graphiste', 'date' => new \Datetime()],
            ['title' => 'Offre de stage développeur Javascript', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony', 'date' => new \Datetime()],
            ['title' => 'Mission de webmaster', 'date' => new \Datetime()],
            ['title' => 'Offre de stage webdesigner', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony/Angular', 'date' => new \Datetime()],
            ['title' => 'Mission de graphiste', 'date' => new \Datetime()],
            ['title' => 'Offre de stage développeur Javascript', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony', 'date' => new \Datetime()],
            ['title' => 'Mission de webmaster', 'date' => new \Datetime()],
            ['title' => 'Offre de stage webdesigner', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony/Angular', 'date' => new \Datetime()],
            ['title' => 'Mission de graphiste', 'date' => new \Datetime()],
            ['title' => 'Offre de stage développeur Javascript', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony', 'date' => new \Datetime()],
            ['title' => 'Mission de webmaster', 'date' => new \Datetime()],
            ['title' => 'Offre de stage webdesigner', 'date' => new \Datetime()],
            ['title' => 'Recherche développeur Symfony/Angular', 'date' => new \Datetime()],
            ['title' => 'Mission de graphiste', 'date' => new \Datetime()],
            ['title' => 'Offre de stage développeur Javascript', 'date' => new \Datetime()],
        ];
        foreach ($names as $name) {
            $advert = new Advert();
            $advert->setTitle($name['title']);
            $advert->setDate($name['date']);
            $advert->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
            //$image = new Image();
            //$image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
            //$image->setAlt('Job de rêve');
            //$manager->persist($image);
            // On lie l'image à l'annonce
            //$advert->setImage($image);

            $department = new Department();
            $department->setName('75 Paris');
            $manager->persist($department);
            $advert->setDepartment($department);
            $advert->setAuthor($this->getReference('recruiter'));
            $manager->persist($advert);
        }
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [UserFixtures::class, CategoryFixtures::class, DepartmentFixtures::class];
    }
}
