<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501132049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE asset (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_2AF5A5CE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset_asset_type (asset_id INT NOT NULL, asset_type_id INT NOT NULL, INDEX IDX_AE5B71BB5DA1941 (asset_id), INDEX IDX_AE5B71BBA6A2CDC5 (asset_type_id), PRIMARY KEY(asset_id, asset_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset_marketing_type (asset_id INT NOT NULL, marketing_type_id INT NOT NULL, INDEX IDX_348F91665DA1941 (asset_id), INDEX IDX_348F91666EA1D71C (marketing_type_id), PRIMARY KEY(asset_id, marketing_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE asset_asset_type ADD CONSTRAINT FK_AE5B71BB5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asset_asset_type ADD CONSTRAINT FK_AE5B71BBA6A2CDC5 FOREIGN KEY (asset_type_id) REFERENCES asset_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asset_marketing_type ADD CONSTRAINT FK_348F91665DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asset_marketing_type ADD CONSTRAINT FK_348F91666EA1D71C FOREIGN KEY (marketing_type_id) REFERENCES marketing_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE asset_asset_type DROP FOREIGN KEY FK_AE5B71BB5DA1941');
        $this->addSql('ALTER TABLE asset_marketing_type DROP FOREIGN KEY FK_348F91665DA1941');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE asset_asset_type');
        $this->addSql('DROP TABLE asset_marketing_type');
    }
}
