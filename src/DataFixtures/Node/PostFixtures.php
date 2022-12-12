<?php

namespace App\DataFixtures\Node;

use App\DataFixtures\UserFixtures;
use App\Entity\Node\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $entity = new Post();

            $entity
                ->setTitle($data['title'])
                ->setSlug($data['slug'])
                ->setExcerpt($data['excerpt'])
                ->setContent($data['content'])
                ->setActif($data['actif'])
                ->setSticky($data['sticky'])
                ->setCommentable($data['commentable'])
                ->setAuthor($this->getReference($data['author']))
            ;

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
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Article News 02',
                'slug' => 'article-news-02',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
            ],
            [
                'author' => 'redacteur01',
                'title' => 'Article News 03',
                'slug' => 'article-news-03',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
            ],
            [
                'author' => 'redacteur02',
                'title' => 'Article News 04',
                'slug' => 'article-news-04',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
            ],
            [
                'author' => 'redacteur03',
                'title' => 'Article News 05',
                'slug' => 'article-news-05',
                'excerpt' => 'Regnis autem superato celsi Cassii regnis coniunxit funditur praetermeans provincias provincias provincias montis Parthenium Orontes.',
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}