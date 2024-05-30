<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240512214300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD adress VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE contenue contenue VARCHAR(15000) DEFAULT NULL, CHANGE evaluation evaluation DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE full_name full_name VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP adress, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE commentaire CHANGE contenue contenue VARCHAR(15000) DEFAULT \'NULL\', CHANGE evaluation evaluation DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE contact CHANGE full_name full_name VARCHAR(50) DEFAULT \'NULL\'');
    }
}
