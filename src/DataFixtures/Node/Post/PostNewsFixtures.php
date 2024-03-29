<?php

namespace App\DataFixtures\Node\Post;

use App\DataFixtures\AppFixtures;
use App\DataFixtures\Node\CategoryFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Node\Post;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\ImageProvider;
use Sonata\MediaBundle\Provider\ImageProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostNewsFixtures extends AppFixtures implements DependentFixtureInterface
{
    public function __construct(
        #[Autowire(service: 'sonata.media.manager.media')] private MediaManagerInterface   $mediaManager,
        #[Autowire(service: 'sonata.media.provider.image')] private ImageProviderInterface $imageProvider,
        #[Autowire('%kernel.project_dir%')] private string                                 $projectDir,
    )
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $entity = new Post();

            $entity
                ->setTitle($data['title'])
                ->setSlug($data['slug'])
                ->setExcerpt($data['excerpt'] ?? null)
                ->setContent($data['content'])
                ->setDraft($data['draft'])
                ->setActif($data['actif'])
                ->setSticky($data['sticky'])
                ->setCommentable($data['commentable'])
                ->setReviewed($data['reviewed'] ?? true)
                ->setDecorated($data['decorated'] ?? true)
                ->setPublishedAt($data['publishedAt'] ?? null)
                ->addCategory($this->getReference('News'))
                ->setAuthor($this->getReference($data['author']));

            if (array_key_exists('image', $data)) {
                $image = $this->mediaManager->create();

                $image->setBinaryContent(new UploadedFile($this->projectDir . DIRECTORY_SEPARATOR . $data['image']['path'], $data['image']['name']));
                $image->setContext('post');
                $image->setProviderName('sonata.media.provider.image');

                if ($this->imageProvider instanceof ImageProvider) {
                    $this->imageProvider->transform($image);
                }

                $entity->setImage($image);
            }

            $this->setReference($data['slug'], $entity);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'author' => 'redacteur01',
                'title' => 'Article News 01',
                'slug' => 'article-news-01',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => $this->parseEditorJs([
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res."
                        ]
                    ],
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut."
                        ]
                    ]
                ]),
                'draft' => false,
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
                'reviewed' => true,
                'decorated' => true,
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-09-02'),
                'image' => [
                    'name' => 'article-news-01.jpg',
                    'path' => '/assets/fixtures/media-01.jpg',
                ],
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Article News 02',
                'slug' => 'article-news-02',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => $this->parseEditorJs([
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res."
                        ]
                    ],
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut."
                        ]
                    ]
                ]),
                'draft' => false,
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
                'reviewed' => true,
                'decorated' => true,
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-09-21'),
                'image' => [
                    'name' => 'article-news-02.jpg',
                    'path' => '/assets/fixtures/media-02.jpg',
                ],
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Article News 03',
                'slug' => 'article-news-03',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => $this->parseEditorJs([
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res."
                        ]
                    ],
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut."
                        ]
                    ]
                ]),
                'draft' => false,
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
                'reviewed' => true,
                'decorated' => true,
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-10-07'),
                'image' => [
                    'name' => 'article-news-03.jpg',
                    'path' => '/assets/fixtures/media-03.jpg',
                ],
            ],
            [
                'author' => 'redacteur02',
                'title' => 'Article News 04',
                'slug' => 'article-news-04',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => $this->parseEditorJs([
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res."
                        ]
                    ],
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut."
                        ]
                    ]
                ]),
                'draft' => false,
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
                'reviewed' => false,
                'decorated' => false,
                'image' => [
                    'name' => 'article-news-04.jpg',
                    'path' => '/assets/fixtures/media-04.jpg',
                ],
            ],
            [
                'author' => 'redacteur03',
                'title' => 'Article News 05',
                'slug' => 'article-news-05',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => $this->parseEditorJs([
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res."
                        ]
                    ],
                    [
                        "type" => "paragraph",
                        "data" => [
                            "text" => "Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut."
                        ]
                    ],
                    [
                        "type" => "image",
                        "data" => [
                            "url" => "https://cdn.pixabay.com/photo/2017/09/01/21/53/blue-2705642_1280.jpg"
                        ]
                    ]
                ]),
                'draft' => true,
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
                'reviewed' => false,
                'decorated' => false,
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
        ];
    }
}