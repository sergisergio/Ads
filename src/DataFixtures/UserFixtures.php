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
        $candidate = new User();
        $candidate->setUsername('Candidate');
        $candidate->setEmail('candidate@candidate.com');
        $candidate->setRoles(['ROLE_CANDIDATE']);
        $candidate->setPassword($this->passwordEncoder->encodePassword($candidate, 'philippe'));
        $candidate->setMode('0');
        $candidate->setValidation(true);
        $manager->persist($candidate);

        $recruiter = new User();
        $recruiter->setUsername('Recruteur');
        $recruiter->setEmail('recruiter@recruiter.com');
        $recruiter->setRoles(['ROLE_RECRUITER']);
        $recruiter->setPassword($this->passwordEncoder->encodePassword($recruiter, 'philippe'));
        $recruiter->setMode('1');
        $recruiter->setValidation(true);
        $manager->persist($candidate);

        $admin = new User();
        $admin->setUsername('Admin');
        $admin->setEmail('admin@admin.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setMode('2');
        $admin->setValidation(true);
        $manager->persist($admin);

        $manager->flush();
        $this->addReference('candidate', $candidate);
        $this->addReference('recruiter', $recruiter);
        $this->addReference('admin', $admin);
    }
}
