<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403155525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE isdeleted isdeleted INT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE isdeleted isdeleted INT NOT NULL');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY session_ibfk_1');
        $this->addSql('ALTER TABLE session CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_membre id_membre INT DEFAULT NULL, CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4D0834EC4 FOREIGN KEY (id_membre) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE IsDeleted IsDeleted INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE isdeleted isdeleted INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE isdeleted isdeleted INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4D0834EC4');
        $this->addSql('ALTER TABLE session CHANGE id id INT NOT NULL, CHANGE id_membre id_membre INT NOT NULL, CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT session_ibfk_1 FOREIGN KEY (id_membre) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE IsDeleted IsDeleted INT DEFAULT 0 NOT NULL');
    }
}
