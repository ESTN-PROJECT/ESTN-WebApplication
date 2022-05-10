<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509222212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation');
        $this->addSql('ALTER TABLE actualite ADD photo VARCHAR(255) DEFAULT \'NULL\', ADD idUser INT DEFAULT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE actualite ADD CONSTRAINT FK_54928197FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('CREATE INDEX idUser ON actualite (idUser)');
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE nom_equipe nom_equipe VARCHAR(20) DEFAULT NULL, CHANGE team_leader_ign team_leader_ign VARCHAR(30) NOT NULL, CHANGE player_2_ign player_2_ign VARCHAR(30) NOT NULL, CHANGE player_3_ign player_3_ign VARCHAR(30) NOT NULL, CHANGE player_4_ign player_4_ign VARCHAR(30) NOT NULL, CHANGE player_5_ign player_5_ign VARCHAR(30) NOT NULL, CHANGE jeu jeu VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE isdeleted isdeleted INT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE reset_password_request DROP selector, DROP hashed_token, DROP requested_at, DROP expires_at, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX nom_eq2 ON scrimms (nom_eq2)');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY session_ibfk_1');
        $this->addSql('ALTER TABLE session CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE id_membre id_membre INT DEFAULT NULL, CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4D0834EC4 FOREIGN KEY (id_membre) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE IsDeleted IsDeleted INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation (user_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_AB55E24FFD02F13 (evenement_id), INDEX IDX_AB55E24FA76ED395 (user_id), PRIMARY KEY(user_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_54928197FE6E88D7');
        $this->addSql('DROP INDEX idUser ON actualite');
        $this->addSql('ALTER TABLE actualite DROP photo, DROP idUser, CHANGE description description TEXT NOT NULL');
        $this->addSql('ALTER TABLE compte utilisateur CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE entrainement CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE nom_equipe nom_equipe VARCHAR(20) NOT NULL, CHANGE team_leader_ign team_leader_ign VARCHAR(20) DEFAULT NULL, CHANGE player_2_ign player_2_ign VARCHAR(20) NOT NULL, CHANGE player_3_ign player_3_ign VARCHAR(20) NOT NULL, CHANGE player_4_ign player_4_ign VARCHAR(20) NOT NULL, CHANGE player_5_ign player_5_ign VARCHAR(20) NOT NULL, CHANGE jeu jeu VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE isdeleted isdeleted INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE liste_envies CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE panier CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE reset_password_request ADD selector VARCHAR(20) NOT NULL, ADD hashed_token VARCHAR(100) NOT NULL, ADD requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE user_id user_id INT NOT NULL');
        $this->addSql('DROP INDEX nom_eq2 ON scrimms');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4D0834EC4');
        $this->addSql('ALTER TABLE session CHANGE id id INT NOT NULL, CHANGE id_membre id_membre INT NOT NULL, CHANGE etat etat INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT session_ibfk_1 FOREIGN KEY (id_membre) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE IsDeleted IsDeleted INT DEFAULT 0 NOT NULL');
    }
}
