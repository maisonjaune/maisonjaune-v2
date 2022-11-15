<?php

namespace App\Entity;

use App\Enum\Role;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends BaseUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id = null;

    #[ORM\Column]
    private ?bool $admin = null;

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = parent::getRoles();

        if ($this->isAdmin()) {
            $roles[] = Role::ROLE_ADMIN->value;
        }

        return $roles;
    }
}
