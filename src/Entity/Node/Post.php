<?php

namespace App\Entity\Node;

use App\Entity\Media\Media;
use App\Entity\Node;
use App\Repository\Node\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: "node_post")]
class Post extends Node
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(groups: ['Content'])]
    private ?string $excerpt = null;

    #[ORM\ManyToOne(cascade: ["persist"])]
    #[Assert\NotBlank(groups: ['Media'])]
    private ?Media $image = null;

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function getImage(): ?Media
    {
        return $this->image;
    }

    public function setImage(?Media $image): self
    {
        $this->image = $image;

        return $this;
    }
}
