<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encode;

    public function __construct(UserPasswordEncoderInterface $encode)
    {
        $this->encode = $encode;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user   ->setEmail('lecomteteddy@gmail.com')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->encode->encodePassword($user, 'password'))
        ;

        $manager->persist($user);

        $manager->flush();
    }
}
