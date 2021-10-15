<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008125547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE village (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, symbol VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ninja ADD village_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ninja ADD CONSTRAINT FK_41E0B2715E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
        $this->addSql('CREATE INDEX IDX_41E0B2715E0D5582 ON ninja (village_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ninja DROP FOREIGN KEY FK_41E0B2715E0D5582');
        $this->addSql('DROP TABLE village');
        $this->addSql('DROP INDEX IDX_41E0B2715E0D5582 ON ninja');
        $this->addSql('ALTER TABLE ninja DROP village_id');
    }
}
