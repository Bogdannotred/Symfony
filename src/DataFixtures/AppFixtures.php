<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = [];
        $emails = ['junior@test.com', 'senior@test.com'];
        $passwords = ['password', 'password123'];

        foreach ($emails as $i => $email) {
            $user = new \App\Entity\User();
            $user->setEmail($email);
            // In a real app we'd hash this, but we'll use a simple hash for demo speed
            // if the user doesn't have a hasher injected. 
            // Better to use plain text if the entity allows or a known hash.
            // Since we don't have the hasher here, we'll set it manually.
            $user->setPassword(password_hash($passwords[$i], PASSWORD_BCRYPT));
            $manager->persist($user);
            $users[] = $user;
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                $task = new \App\Entity\Task();
                $task->setTitle("Objective " . ($i + 1) . " for " . $user->getEmail());
                $task->setDescription("This is a premium task description for objective " . ($i + 1));
                $task->setIsDone($i % 3 == 0);
                $task->setOwner($user);
                
                // Varied dates for sorting demo
                $date = new \DateTimeImmutable("-" . ($i * 3) . " days");
                $task->setCreatedAt($date);
                
                $manager->persist($task);
            }
        }

        $manager->flush();
    }
}
