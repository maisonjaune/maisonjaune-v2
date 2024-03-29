<?php

namespace App\DataFixtures\Node\Brief;

use App\DataFixtures\AppFixtures;
use App\DataFixtures\Node\CategoryFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Node\Brief;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BriefNewsFixtures extends AppFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $entity = new Brief();

            $entity
                ->setTitle($data['title'])
                ->setSlug($data['slug'])
                ->setContent($data['content'])
                ->setDraft($data['draft'])
                ->setActif($data['actif'])
                ->setSticky($data['sticky'])
                ->setCommentable($data['commentable'])
                ->setPublishedAt($data['publishedAt'] ?? null)
                ->addCategory($this->getReference('News'))
                ->setAuthor($this->getReference($data['author']));

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
                'title' => 'Brève News 01',
                'slug' => 'breve-news-01',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-09-04'),
            ],
            [
                'author' => 'redacteur02',
                'title' => 'Brève News 02',
                'slug' => 'breve-news-02',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-09-15'),
            ],
            [
                'author' => 'redacteur03',
                'title' => 'Brève News 03',
                'slug' => 'breve-news-03',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-09-24'),
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Brève News 04',
                'slug' => 'breve-news-04',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-10-02'),
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Brève News 05',
                'slug' => 'breve-news-05',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-10-06'),
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Brève News 06',
                'slug' => 'breve-news-06',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-10-16'),
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Brève News 07',
                'slug' => 'breve-news-07',
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
                'publishedAt' => DateTimeImmutable::createFromFormat('Y-m-d','2022-11-03'),
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