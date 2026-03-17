<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $userData = [
            ['email' => 'junior@test.com', 'password' => 'password'],
            ['email' => 'senior@test.com', 'password' => 'password123'],
        ];

        foreach ($userData as $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setRoles(['ROLE_USER']);

            $hashedPassword = $this->hasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);


            for ($i = 1; $i <= 5; $i++) {
                $task = new Task();
                $task->setTitle("Task demo $i pentru " . $user->getEmail());
                $task->setDescription("Aceasta este descrierea pentru task-ul numărul $i.");
                $task->setIsDone((bool)rand(0, 1));
                $task->setOwner($user);
                $manager->persist($task);
            }
        }
        $manager->flush();
    }
}