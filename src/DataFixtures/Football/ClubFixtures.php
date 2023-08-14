<?php

namespace App\DataFixtures\Football;

use App\DataFixtures\AppFixtures;
use App\Entity\Football\Club;
use Doctrine\Persistence\ObjectManager;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\ImageProvider;
use Sonata\MediaBundle\Provider\ImageProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ClubFixtures extends AppFixtures
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
            $entity = new Club();

            $entity
                ->setName($data['name']);

            $logo = $this->mediaManager->create();

            $logo->setBinaryContent(new UploadedFile($this->projectDir . '/assets/fixtures/clubs/' . $data['logo'], $data['name'] . '.png'));
            $logo->setContext('club');
            $logo->setProviderName('sonata.media.provider.image');

            if ($this->imageProvider instanceof ImageProvider) {
                $this->imageProvider->transform($logo);
            }

            $entity->setLogo($logo);

            $manager->persist($entity);

            $this->setReference($data['name'], $entity);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                'name' => 'Amiens SC',
                'logo' => 'Amiens SC.png',
            ], [
                'name' => 'Angers SCO',
                'logo' => 'Angers.png',
            ], [
                'name' => 'FC Girondins de Bordeaux',
                'logo' => 'Bordeaux.png',
            ], [
                'name' => 'Stade Brestois 29',
                'logo' => 'Brest.png',
            ], [
                'name' => 'Stade Malherbe Caen',
                'logo' => 'Caen.png',
            ], [
                'name' => 'Clermont Foot',
                'logo' => 'Clermont.png',
            ], [
                'name' => 'Dijon FCO',
                'logo' => 'Dijon.png',
            ], [
                'name' => 'En Avant Guingamp',
                'logo' => 'Guingamp.png',
            ], [
                'name' => 'RC Lens',
                'logo' => 'Lens.png',
            ], [
                'name' => 'FC Lorient',
                'logo' => 'Lorient.png',
            ], [
                'name' => 'LOSC Lille',
                'logo' => 'LOSC.png',
            ], [
                'name' => 'Olympique Lyonnais',
                'logo' => 'Lyon.png',
            ], [
                'name' => 'Olympique de Marseille',
                'logo' => 'OM.png',
            ], [
                'name' => 'FC Metz',
                'logo' => 'Metz.png',
            ], [
                'name' => 'AS Monaco',
                'logo' => 'Monaco.png',
            ], [
                'name' => 'Montpellier HSC',
                'logo' => 'Montpellier.png',
            ], [
                'name' => 'FC Nantes',
                'logo' => 'Nantes.png',
            ], [
                'name' => 'OGC Nice',
                'logo' => 'Nice.png',
            ], [
                'name' => 'Nîmes Olympique',
                'logo' => 'Nîmes.png',
            ], [
                'name' => 'Paris Saint-Germain',
                'logo' => 'PSG.png',
            ], [
                'name' => 'Stade Rennais FC',
                'logo' => 'Rennes.png',
            ], [
                'name' => 'AS Saint-Étienne',
                'logo' => 'St-Étienne.png',
            ], [
                'name' => 'Stade de Reims',
                'logo' => 'Reims.png',
            ], [
                'name' => 'RC Strasbourg Alsace',
                'logo' => 'Strasbourg.png',
            ], [
                'name' => 'Toulouse FC',
                'logo' => 'Toulouse.png',
            ], [
                'name' => 'ES Troyes AC',
                'logo' => 'Troyes.png',
            ]
        ];
    }
}