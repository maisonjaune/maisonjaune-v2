<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221204912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE football_championship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE football_club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE football_game (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_home_id INT NOT NULL, team_outside_id INT NOT NULL, date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', score_home INT DEFAULT NULL, score_outside INT DEFAULT NULL, INDEX IDX_22F2A1594EC001D1 (season_id), INDEX IDX_22F2A159D7B4B9AB (team_home_id), INDEX IDX_22F2A15964A00204 (team_outside_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE football_season (id INT AUTO_INCREMENT NOT NULL, championship_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_FCA4F86E94DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season_team (season_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_42A93A814EC001D1 (season_id), INDEX IDX_42A93A81296CD8AE (team_id), PRIMARY KEY(season_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE football_team (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, name VARCHAR(150) NOT NULL, INDEX IDX_C53936CA61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE football_game ADD CONSTRAINT FK_22F2A1594EC001D1 FOREIGN KEY (season_id) REFERENCES football_season (id)');
        $this->addSql('ALTER TABLE football_game ADD CONSTRAINT FK_22F2A159D7B4B9AB FOREIGN KEY (team_home_id) REFERENCES football_team (id)');
        $this->addSql('ALTER TABLE football_game ADD CONSTRAINT FK_22F2A15964A00204 FOREIGN KEY (team_outside_id) REFERENCES football_team (id)');
        $this->addSql('ALTER TABLE football_season ADD CONSTRAINT FK_FCA4F86E94DDBCE9 FOREIGN KEY (championship_id) REFERENCES football_championship (id)');
        $this->addSql('ALTER TABLE season_team ADD CONSTRAINT FK_42A93A814EC001D1 FOREIGN KEY (season_id) REFERENCES football_season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season_team ADD CONSTRAINT FK_42A93A81296CD8AE FOREIGN KEY (team_id) REFERENCES football_team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE football_team ADD CONSTRAINT FK_C53936CA61190A32 FOREIGN KEY (club_id) REFERENCES football_club (id)');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F61190A32');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE team');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, name VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C4E0A61F61190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE football_game DROP FOREIGN KEY FK_22F2A1594EC001D1');
        $this->addSql('ALTER TABLE football_game DROP FOREIGN KEY FK_22F2A159D7B4B9AB');
        $this->addSql('ALTER TABLE football_game DROP FOREIGN KEY FK_22F2A15964A00204');
        $this->addSql('ALTER TABLE football_season DROP FOREIGN KEY FK_FCA4F86E94DDBCE9');
        $this->addSql('ALTER TABLE season_team DROP FOREIGN KEY FK_42A93A814EC001D1');
        $this->addSql('ALTER TABLE season_team DROP FOREIGN KEY FK_42A93A81296CD8AE');
        $this->addSql('ALTER TABLE football_team DROP FOREIGN KEY FK_C53936CA61190A32');
        $this->addSql('DROP TABLE football_championship');
        $this->addSql('DROP TABLE football_club');
        $this->addSql('DROP TABLE football_game');
        $this->addSql('DROP TABLE football_season');
        $this->addSql('DROP TABLE season_team');
        $this->addSql('DROP TABLE football_team');
    }
}
