<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802120734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_taille_boisson (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, tailleboisson_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_9CA1CDB282EA2E54 (commande_id), INDEX IDX_9CA1CDB236F1CA00 (tailleboisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_taille_boisson ADD CONSTRAINT FK_9CA1CDB282EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_taille_boisson ADD CONSTRAINT FK_9CA1CDB236F1CA00 FOREIGN KEY (tailleboisson_id) REFERENCES taille_boisson (id)');
        $this->addSql('ALTER TABLE produit ADD description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_taille_boisson');
        $this->addSql('ALTER TABLE produit DROP description');
    }
}
