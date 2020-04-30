<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430113900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, sku VARCHAR(64) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_232B318CF9038C4 (sku), UNIQUE INDEX UNIQ_232B318C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE game');
    }

    public function postUp(Schema $schema) : void
    {
        $this->connection->executeQuery("INSERT INTO game (sku, name) VALUES ('SG 455', 'IQ Puzzler Pro'), ('SG 444', 'IQ Twist'), ('SG 443', 'IQ Stars'), ('SG 442', 'IQ Focus')");
    }
}
