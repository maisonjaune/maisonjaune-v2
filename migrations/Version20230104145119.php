<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104145119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE football_club ADD logo_id INT NOT NULL');
        $this->addSql('ALTER TABLE football_club ADD CONSTRAINT FK_B937A8A7F98F144A FOREIGN KEY (logo_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_B937A8A7F98F144A ON football_club (logo_id)');
        $this->addSql('ALTER TABLE football_season_team RENAME INDEX idx_42a93a814ec001d1 TO IDX_9A6D7A6D4EC001D1');
        $this->addSql('ALTER TABLE football_season_team RENAME INDEX idx_42a93a81296cd8ae TO IDX_9A6D7A6D296CD8AE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE football_club DROP FOREIGN KEY FK_B937A8A7F98F144A');
        $this->addSql('DROP INDEX IDX_B937A8A7F98F144A ON football_club');
        $this->addSql('ALTER TABLE football_club DROP logo_id');
        $this->addSql('ALTER TABLE football_season_team RENAME INDEX idx_9a6d7a6d4ec001d1 TO IDX_42A93A814EC001D1');
        $this->addSql('ALTER TABLE football_season_team RENAME INDEX idx_9a6d7a6d296cd8ae TO IDX_42A93A81296CD8AE');
    }
}
