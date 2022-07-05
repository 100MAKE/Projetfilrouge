<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705164539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE burger_menu');
        $this->addSql('ALTER TABLE client ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD is_enable TINYINT(1) NOT NULL, ADD token VARCHAR(255) NOT NULL, ADD expire_at DATETIME NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger_menu (burger_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_E42E02517CE5090 (burger_id), INDEX IDX_E42E025CCD7E912 (menu_id), PRIMARY KEY(burger_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E025CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_menu ADD CONSTRAINT FK_E42E02517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_C7440455E7927C74 ON client');
        $this->addSql('ALTER TABLE client DROP roles, DROP is_enable, DROP token, DROP expire_at, CHANGE email email VARCHAR(255) NOT NULL');
    }
}
