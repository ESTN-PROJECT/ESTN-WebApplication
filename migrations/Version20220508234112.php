<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508234112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation (user_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_AB55E24FA76ED395 (user_id), INDEX IDX_AB55E24FFD02F13 (evenement_id), PRIMARY KEY(user_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE evenement MODIFY id_event INT NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE evenement CHANGE isdeleted isdeleted INT NOT NULL, CHANGE id_event id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE jeu CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY session_ibfk_1');
        $this->addSql('ALTER TABLE session CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_membre id_membre INT DEFAULT NULL, CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4D0834EC4 FOREIGN KEY (id_membre) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE IsDeleted IsDeleted INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation');
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE evenement MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE evenement CHANGE isdeleted isdeleted INT DEFAULT 0 NOT NULL, CHANGE id id_event INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (id_event)');
        $this->addSql('ALTER TABLE jeu CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4D0834EC4');
        $this->addSql('ALTER TABLE session CHANGE id id INT NOT NULL, CHANGE id_membre id_membre INT NOT NULL, CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT session_ibfk_1 FOREIGN KEY (id_membre) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE IsDeleted IsDeleted INT DEFAULT 0 NOT NULL');
    }
}
