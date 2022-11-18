<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118204513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création de la relation entre un post et un  media';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE node_post ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE node_post ADD CONSTRAINT FK_9D2EE11B3DA5256D FOREIGN KEY (image_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_9D2EE11B3DA5256D ON node_post (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE node_post DROP FOREIGN KEY FK_9D2EE11B3DA5256D');
        $this->addSql('DROP INDEX IDX_9D2EE11B3DA5256D ON node_post');
        $this->addSql('ALTER TABLE node_post DROP image_id');
    }
}
