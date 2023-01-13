<?php

namespace App\Form\Node;

use App\Entity\Node\Post;
use App\Enum\Node\FormPostType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (in_array($options['form_type'], [FormPostType::TYPE_CREATE, FormPostType::TYPE_WRITE])) {
            $builder
                ->add('title', null, [
                    'attr' => [
                        'x-model' => "title"
                    ]
                ])
                ->add('slug');
        }

        if (in_array($options['form_type'], [FormPostType::TYPE_WRITE, FormPostType::TYPE_EXAMINE])) {
            $builder
                ->add('excerpt', null, [
                    'attr' => [
                        'x-model' => "excerpt"
                    ]
                ])
                ->add('content', HiddenType::class, [
                    'attr' => [
                        'data-editor' => "content"
                    ]
                ]);
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
