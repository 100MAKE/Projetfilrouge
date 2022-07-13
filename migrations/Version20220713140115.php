<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713140115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_menu (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, prix INT NOT NULL, INDEX IDX_16693B70CCD7E912 (menu_id), INDEX IDX_16693B7082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_menu ADD CONSTRAINT FK_16693B70CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE commande_menu ADD CONSTRAINT FK_16693B7082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_burger ADD prix INT NOT NULL');
        $this->addSql('ALTER TABLE commande_portion_frite ADD prix INT NOT NULL');
        $this->addSql('ALTER TABLE commande_taille ADD prix INT NOT NULL');
        $this->addSql('ALTER TABLE quartier ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_FEE8962D9F2C3FAB ON quartier (zone_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_menu');
        $this->addSql('ALTER TABLE commande_burger DROP prix');
        $this->addSql('ALTER TABLE commande_portion_frite DROP prix');
        $this->addSql('ALTER TABLE commande_taille DROP prix');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP INDEX IDX_FEE8962D9F2C3FAB ON quartier');
        $this->addSql('ALTER TABLE quartier DROP zone_id');
    }
}
