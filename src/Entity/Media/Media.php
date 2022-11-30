<?php

namespace App\Entity\Media;

use App\Repository\Media\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Entity\BaseMedia;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media extends BaseMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
