<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Philippe');
        $user->setEmail('ptraon@gmail.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'philippe'));
        $manager->persist($user);
        $admin = new User();
        $admin->setUsername('Admin');
        $admin->setEmail('admin@admin.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($user,'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
        $this->addReference('user', $user);
        $this->addReference('admin', $admin);
    }
}
