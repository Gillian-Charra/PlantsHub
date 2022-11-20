<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119082642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_has_discovered (id INT AUTO_INCREMENT NOT NULL, plant_id INT NOT NULL, user_id INT NOT NULL, longitude VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_58E8340E1D935652 (plant_id), INDEX IDX_58E8340EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_has_discovered ADD CONSTRAINT FK_58E8340E1D935652 FOREIGN KEY (plant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE user_has_discovered ADD CONSTRAINT FK_58E8340EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_dicovered DROP FOREIGN KEY FK_DBBF3FBDB7461E5F');
        $this->addSql('ALTER TABLE user_has_dicovered DROP FOREIGN KEY FK_DBBF3FBD786A81FB');
        $this->addSql('DROP TABLE user_has_dicovered');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_has_dicovered (id INT AUTO_INCREMENT NOT NULL, idplant_id INT NOT NULL, iduser_id INT DEFAULT NULL, longitude NUMERIC(10, 10) NOT NULL, latitude NUMERIC(10, 10) NOT NULL, date DATETIME NOT NULL, photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_DBBF3FBD786A81FB (iduser_id), INDEX IDX_DBBF3FBDB7461E5F (idplant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_has_dicovered ADD CONSTRAINT FK_DBBF3FBDB7461E5F FOREIGN KEY (idplant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE user_has_dicovered ADD CONSTRAINT FK_DBBF3FBD786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_discovered DROP FOREIGN KEY FK_58E8340E1D935652');
        $this->addSql('ALTER TABLE user_has_discovered DROP FOREIGN KEY FK_58E8340EA76ED395');
        $this->addSql('DROP TABLE user_has_discovered');
    }
}
