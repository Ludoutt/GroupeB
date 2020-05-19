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
        $user1 = new User();
        $user2 = new User();
        $user3 = new User();

        $user1  ->setEmail('lecomteteddy@gmail.com')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->encode->encodePassword($user1, 'password'))
        ;

        $user2  ->setEmail('snativel@gmail.com')
                ->setRoles(['ROLE_USER'])
                ->setPassword($this->encode->encodePassword($user2, 'password'))
        ;

        $user3  ->setEmail('n.yochum@gmail.com')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->encode->encodePassword($user3, 'password'))
        ;

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);

        $manager->flush();
    }
}
