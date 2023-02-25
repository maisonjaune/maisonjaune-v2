<?php

namespace App\Form\Node;

use App\Entity\Media\Media;
use App\Entity\Node\Category;
use App\Entity\Node\Post;
use App\Enum\Node\FormPostType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        if (in_array($options['form_type'], [FormPostType::TYPE_CREATE, FormPostType::TYPE_WRITE, FormPostType::TYPE_REVIEW])) {
            $builder
                ->add('title', null, [
                    'attr' => [
                        'data-input' => "title"
                    ]
                ])
                ->add('slug');
        }

        if (in_array($options['form_type'], [FormPostType::TYPE_WRITE, FormPostType::TYPE_REVIEW])) {
            $builder
                ->add('excerpt', null, [
                    'attr' => [
                        'data-input' => "excerpt"
                    ]
                ])
                ->add('content', HiddenType::class, [
                    'attr' => [
                        'data-input' => "content"
                    ]
                ]);

            if (in_array($options['form_type'], [FormPostType::TYPE_WRITE])) {
                $builder
                    ->add('categories', EntityType::class, [
                        'class' => Category::class,
                        'choice_label' => 'name',
                        'multiple' => true,
                        'expanded' => true,
                        'attr' => [
                            'data-input' => "categories",
                            'data-callback' => "checkboxesRenderer",
                        ],
                    ]);
            }
        }

        if ($options['form_type'] === FormPostType::TYPE_DECORATE) {
            $builder
                ->add('image', MediaType::class, [
                    'data_class' => Media::class,
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'post',
                ]);
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
