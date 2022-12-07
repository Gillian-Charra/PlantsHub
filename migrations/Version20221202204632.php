<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202204632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plant_images (id INT AUTO_INCREMENT NOT NULL, plant_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_38F6FE11D935652 (plant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plant_images ADD CONSTRAINT FK_38F6FE11D935652 FOREIGN KEY (plant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE plant DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_images DROP FOREIGN KEY FK_38F6FE11D935652');
        $this->addSql('DROP TABLE plant_images');
        $this->addSql('ALTER TABLE plant ADD image VARCHAR(255) NOT NULL');
    }
}
