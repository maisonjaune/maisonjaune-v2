<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserManagerInterface $userManager,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $entity = $this->userManager->createUser();

            if ($entity instanceof User) {
                $entity
                    ->setUsername($data['username'])
                    ->setEmail($data['email'])
                    ->setPlainPassword('azerty')
                    ->setEnabled($data['enabled'])
                    ->setAdmin($data['admin'])
                    ->setSuperAdmin($data['super_admin']);
            }

            $this->setReference($data['username'], $entity);

            $this->userManager->updateUser($entity);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'username' => 'superadmin',
                'email' => 'super.admin@mail.test',
                'enabled' => true,
                'admin' => true,
                'super_admin' => true,
            ],
            [
                'username' => 'admin',
                'email' => 'admin@mail.test',
                'enabled' => true,
                'admin' => true,
                'super_admin' => false,
            ],
            [
                'username' => 'enabled.user',
                'email' => 'enabled.user@mail.test',
                'enabled' => true,
                'admin' => false,
                'super_admin' => false,
            ],
            [
                'username' => 'disabled.user',
                'email' => 'disabled.user@mail.test',
                'enabled' => false,
                'admin' => false,
                'super_admin' => false,
            ],
        ];
    }
}
