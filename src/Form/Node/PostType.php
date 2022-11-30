<?php

namespace App\Form\Node;

use App\Entity\Node\Post;
use App\Enum\Node\FormPostType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['form_type'] === FormPostType::TYPE_CREATE) {
            $builder
                ->add('title')
                ->add('slug');
        }

        if ($options['form_type'] === FormPostType::TYPE_WRITE) {
            $builder
                ->add('content');
        }

        if ($options['form_type'] === FormPostType::TYPE_EXAMINE) {
            $builder
                ->add('excerpt')
                ->add('content');
        }

        if ($options['form_type'] === FormPostType::TYPE_DECORATE) {
            $builder
                ->add('image');
        }

        if ($options['form_type'] === FormPostType::TYPE_PUBLISH) {
            $builder
                ->add('commentable')
                ->add('sticky')
                ->add('actif')
                ->add('publishedAt');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'form_type' => FormPostType::TYPE_CREATE
        ]);

        $resolver->setAllowedTypes('form_type', FormPostType::class);
        $resolver->setAllowedValues('form_type', FormPostType::cases());
    }
}
