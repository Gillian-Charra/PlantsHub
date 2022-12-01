<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115094725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, idtype_id INT NOT NULL, content VARCHAR(255) NOT NULL, side TINYINT(1) NOT NULL, ordre INT NOT NULL, INDEX IDX_41405E391A48DEFD (idtype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element_plant (element_id INT NOT NULL, plant_id INT NOT NULL, INDEX IDX_6F2179EB1F1F2A24 (element_id), INDEX IDX_6F2179EB1D935652 (plant_id), PRIMARY KEY(element_id, plant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, html_tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_dicovered (id INT AUTO_INCREMENT NOT NULL, idplant_id INT NOT NULL, iduser_id INT DEFAULT NULL, longitude NUMERIC(10, 10) NOT NULL, latitude NUMERIC(10, 10) NOT NULL, date DATETIME NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_DBBF3FBDB7461E5F (idplant_id), INDEX IDX_DBBF3FBD786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E391A48DEFD FOREIGN KEY (idtype_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE element_plant ADD CONSTRAINT FK_6F2179EB1F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_plant ADD CONSTRAINT FK_6F2179EB1D935652 FOREIGN KEY (plant_id) REFERENCES plant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_has_dicovered ADD CONSTRAINT FK_DBBF3FBDB7461E5F FOREIGN KEY (idplant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE user_has_dicovered ADD CONSTRAINT FK_DBBF3FBD786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E391A48DEFD');
        $this->addSql('ALTER TABLE element_plant DROP FOREIGN KEY FK_6F2179EB1F1F2A24');
        $this->addSql('ALTER TABLE element_plant DROP FOREIGN KEY FK_6F2179EB1D935652');
        $this->addSql('ALTER TABLE user_has_dicovered DROP FOREIGN KEY FK_DBBF3FBDB7461E5F');
        $this->addSql('ALTER TABLE user_has_dicovered DROP FOREIGN KEY FK_DBBF3FBD786A81FB');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE element_plant');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_dicovered');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
