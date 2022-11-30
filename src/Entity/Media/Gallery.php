<?php

namespace App\Entity\Media;

use App\Repository\Media\GalleryRepository;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Entity\BaseGallery;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery extends BaseGallery
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
