<?php

namespace App\DataFixtures\Node\Post;

use App\DataFixtures\UserFixtures;
use App\Entity\Media\Media;
use App\Entity\Node\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\ImageProvider;
use Sonata\MediaBundle\Provider\ImageProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostNewsFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private string                 $projectDir,
        #[Autowire(service: 'sonata.media.manager.media')]
        private MediaManagerInterface  $mediaManager,
        #[Autowire(service: 'sonata.media.provider.image')]
        private ImageProviderInterface $imageProvider,
    )
    {
    }

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
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
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
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
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
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
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
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
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
                'content' => '<p>Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res.</p><p>Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut.</p>',
                'actif' => true,
                'sticky' => true,
                'commentable' => true,
                'image' => [
                    'name' => 'article-news-05.jpg',
                    'path' => '/assets/fixtures/media-05.jpg',
                ],
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