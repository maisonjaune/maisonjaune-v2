<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214124149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_category (post_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B9A190604B89032C (post_id), INDEX IDX_B9A1906012469DE2 (category_id), PRIMARY KEY(post_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_category ADD CONSTRAINT FK_B9A190604B89032C FOREIGN KEY (post_id) REFERENCES node_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_category ADD CONSTRAINT FK_B9A1906012469DE2 FOREIGN KEY (category_id) REFERENCES node_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_item ADD gallery_id INT DEFAULT NULL, ADD media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gallery_item ADD CONSTRAINT FK_8C040D924E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery_item ADD CONSTRAINT FK_8C040D92EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8C040D924E7AF8F ON gallery_item (gallery_id)');
        $this->addSql('CREATE INDEX IDX_8C040D92EA9FDD75 ON gallery_item (media_id)');
        $this->addSql('ALTER TABLE user ADD lastname VARCHAR(100) DEFAULT NULL AFTER email_canonical, ADD firstname VARCHAR(100) DEFAULT NULL AFTER email_canonical');
        $this->addSql('CREATE TABLE brief_category (brief_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E0A4AB57757FABFF (brief_id), INDEX IDX_E0A4AB5712469DE2 (category_id), PRIMARY KEY(brief_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE brief_category ADD CONSTRAINT FK_E0A4AB57757FABFF FOREIGN KEY (brief_id) REFERENCES node_brief (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brief_category ADD CONSTRAINT FK_E0A4AB5712469DE2 FOREIGN KEY (category_id) REFERENCES node_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_category DROP FOREIGN KEY FK_B9A190604B89032C');
        $this->addSql('ALTER TABLE post_category DROP FOREIGN KEY FK_B9A1906012469DE2');
        $this->addSql('DROP TABLE post_category');
        $this->addSql('ALTER TABLE gallery_item DROP FOREIGN KEY FK_8C040D924E7AF8F');
        $this->addSql('ALTER TABLE gallery_item DROP FOREIGN KEY FK_8C040D92EA9FDD75');
        $this->addSql('DROP INDEX IDX_8C040D924E7AF8F ON gallery_item');
        $this->addSql('DROP INDEX IDX_8C040D92EA9FDD75 ON gallery_item');
        $this->addSql('ALTER TABLE gallery_item DROP gallery_id, DROP media_id');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname');
        $this->addSql('ALTER TABLE brief_category DROP FOREIGN KEY FK_E0A4AB57757FABFF');
        $this->addSql('ALTER TABLE brief_category DROP FOREIGN KEY FK_E0A4AB5712469DE2');
        $this->addSql('DROP TABLE brief_category');
    }
}
