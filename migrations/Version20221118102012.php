<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118102012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element ADD idplant_id INT NOT NULL');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39B7461E5F FOREIGN KEY (idplant_id) REFERENCES plant (id)');
        $this->addSql('CREATE INDEX IDX_41405E39B7461E5F ON element (idplant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39B7461E5F');
        $this->addSql('DROP INDEX IDX_41405E39B7461E5F ON element');
        $this->addSql('ALTER TABLE element DROP idplant_id');
    }
}
