<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201133255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E391A48DEFD');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39B7461E5F');
        $this->addSql('ALTER TABLE element_plant DROP FOREIGN KEY FK_6F2179EB1D935652');
        $this->addSql('ALTER TABLE element_plant DROP FOREIGN KEY FK_6F2179EB1F1F2A24');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE element_plant');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72C35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
        $this->addSql('CREATE INDEX IDX_AB030D72C35E566A ON plant (family_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, idtype_id INT NOT NULL, idplant_id INT NOT NULL, content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, side TINYINT(1) NOT NULL, ordre INT NOT NULL, INDEX IDX_41405E391A48DEFD (idtype_id), INDEX IDX_41405E39B7461E5F (idplant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE element_plant (element_id INT NOT NULL, plant_id INT NOT NULL, INDEX IDX_6F2179EB1F1F2A24 (element_id), INDEX IDX_6F2179EB1D935652 (plant_id), PRIMARY KEY(element_id, plant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, html_tag VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, html_tag_end VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E391A48DEFD FOREIGN KEY (idtype_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39B7461E5F FOREIGN KEY (idplant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE element_plant ADD CONSTRAINT FK_6F2179EB1D935652 FOREIGN KEY (plant_id) REFERENCES plant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_plant ADD CONSTRAINT FK_6F2179EB1F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72C35E566A');
        $this->addSql('DROP INDEX IDX_AB030D72C35E566A ON plant');
    }
}
