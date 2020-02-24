<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200223131803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4A6E44244 FOREIGN KEY (pays_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_7D3656A4A6E44244 ON account (pays_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4A6E44244');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4ED16FA20');
        $this->addSql('DROP INDEX IDX_7D3656A4A6E44244 ON account');
    }
}
