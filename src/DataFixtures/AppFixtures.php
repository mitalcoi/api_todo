<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('api');
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'api'));
        $manager->persist($user);

        $todo = new Todo('000-000-0001');
        $todo->setTitle('Test todo');
        $manager->persist($todo);

        $manager->flush();
    }
}
