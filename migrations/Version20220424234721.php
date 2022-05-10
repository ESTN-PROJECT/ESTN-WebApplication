<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424234721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE discussion CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE forum CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE scrimms DROP date_debut, DROP date_fin');
        $this->addSql('ALTER TABLE session CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE discussion CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE forum CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE scrimms ADD date_debut DATETIME DEFAULT NULL, ADD date_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE session CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE id id INT NOT NULL');
    }
}
