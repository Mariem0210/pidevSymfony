<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404193526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches (idm INT AUTO_INCREMENT NOT NULL, idt INT DEFAULT NULL, equipe1 VARCHAR(255) NOT NULL, equipe2 VARCHAR(255) NOT NULL, date_debutm DATE NOT NULL, status VARCHAR(255) NOT NULL, score VARCHAR(255) NOT NULL, INDEX IDX_62615BAEEBE323B (idt), PRIMARY KEY(idm)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BAEEBE323B FOREIGN KEY (idt) REFERENCES tournois (idt)');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY fk_tournois_match');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP INDEX fk_user_certificat ON certificat');
        $this->addSql('DROP INDEX fk_formation_certificat ON certificat');
        $this->addSql('ALTER TABLE certificat CHANGE nomc nomc VARCHAR(255) NOT NULL, CHANGE typec typec VARCHAR(255) NOT NULL, CHANGE etatc etatc VARCHAR(255) NOT NULL, CHANGE dateExpirationc date_expirationc DATE NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('ALTER TABLE commande CHANGE idu idu INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99B902AD FOREIGN KEY (idu) REFERENCES utilisateur (idu)');
        $this->addSql('DROP INDEX idu ON commande');
        $this->addSql('CREATE INDEX IDX_6EEAA67D99B902AD ON commande (idu)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (idu) REFERENCES utilisateur (idu) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idu ON equipe');
        $this->addSql('ALTER TABLE equipe CHANGE nom_equipe nom_equipe VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX fk_user_formation ON formation');
        $this->addSql('ALTER TABLE formation ADD date_debutf DATE NOT NULL, ADD date_finf DATE NOT NULL, DROP dateDebutf, DROP dateFinf, CHANGE nomf nomf VARCHAR(255) NOT NULL, CHANGE niveauf niveauf VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE giveaway CHANGE titreg titreg VARCHAR(255) NOT NULL, CHANGE descg descg VARCHAR(255) NOT NULL, CHANGE statusg statusg VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX fk_user_offre ON offre_de_rectrutement');
        $this->addSql('ALTER TABLE offre_de_rectrutement CHANGE poste_recherche poste_recherche VARCHAR(255) NOT NULL, CHANGE niveu_requis niveu_requis VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE contrat contrat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_1');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_2');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_1');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_2');
        $this->addSql('ALTER TABLE panier CHANGE idu idu INT DEFAULT NULL, CHANGE id_produit id_produit INT DEFAULT NULL, CHANGE date_ajout date_ajout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF299B902AD FOREIGN KEY (idu) REFERENCES utilisateur (idu)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('DROP INDEX idu ON panier');
        $this->addSql('CREATE INDEX IDX_24CC0DF299B902AD ON panier (idu)');
        $this->addSql('DROP INDEX id_produit ON panier');
        $this->addSql('CREATE INDEX IDX_24CC0DF2F7384557 ON panier (id_produit)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (idu) REFERENCES utilisateur (idu) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_2 FOREIGN KEY (id_produit) REFERENCES produit (id_produit) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit CHANGE description description LONGTEXT DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE rating CHANGE note note NUMERIC(10, 0) NOT NULL');
        $this->addSql('ALTER TABLE tournois CHANGE nomt nomt VARCHAR(255) NOT NULL, CHANGE descriptiont descriptiont VARCHAR(255) NOT NULL, CHANGE statutt statutt VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE transfert CHANGE ancienne_equipe ancienne_equipe VARCHAR(255) NOT NULL, CHANGE nouvelle_equipe nouvelle_equipe VARCHAR(255) NOT NULL, CHANGE datet datet DATE NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE typeu typeu VARCHAR(30) NOT NULL, CHANGE code_expiration code_expiration DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B38A3B8530 ON utilisateur (mailu)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `match` (idm INT AUTO_INCREMENT NOT NULL, idt INT NOT NULL, equipe1 VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, equipe2 VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_debutm DATE NOT NULL, status VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, score VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_tournois_match (idt), PRIMARY KEY(idm)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT fk_tournois_match FOREIGN KEY (idt) REFERENCES tournois (idt) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BAEEBE323B');
        $this->addSql('DROP TABLE matches');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE certificat CHANGE nomc nomc VARCHAR(100) NOT NULL, CHANGE typec typec VARCHAR(50) NOT NULL, CHANGE etatc etatc VARCHAR(100) NOT NULL, CHANGE date_expirationc dateExpirationc DATE NOT NULL');
        $this->addSql('CREATE INDEX fk_user_certificat ON certificat (idf)');
        $this->addSql('CREATE INDEX fk_formation_certificat ON certificat (idu)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99B902AD');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99B902AD');
        $this->addSql('ALTER TABLE commande CHANGE idu idu INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (idu) REFERENCES utilisateur (idu) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_6eeaa67d99b902ad ON commande');
        $this->addSql('CREATE INDEX idu ON commande (idu)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99B902AD FOREIGN KEY (idu) REFERENCES utilisateur (idu)');
        $this->addSql('ALTER TABLE equipe CHANGE nom_equipe nom_equipe VARCHAR(50) NOT NULL');
        $this->addSql('CREATE INDEX idu ON equipe (idu)');
        $this->addSql('ALTER TABLE formation ADD dateDebutf DATE NOT NULL, ADD dateFinf DATE NOT NULL, DROP date_debutf, DROP date_finf, CHANGE nomf nomf VARCHAR(30) NOT NULL, CHANGE niveauf niveauf VARCHAR(50) NOT NULL');
        $this->addSql('CREATE INDEX fk_user_formation ON formation (idu)');
        $this->addSql('ALTER TABLE giveaway CHANGE titreg titreg VARCHAR(40) NOT NULL, CHANGE descg descg VARCHAR(50) NOT NULL, CHANGE statusg statusg VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE offre_de_rectrutement CHANGE poste_recherche poste_recherche VARCHAR(50) NOT NULL, CHANGE niveu_requis niveu_requis VARCHAR(50) NOT NULL, CHANGE status status VARCHAR(50) NOT NULL, CHANGE contrat contrat VARCHAR(50) NOT NULL');
        $this->addSql('CREATE INDEX fk_user_offre ON offre_de_rectrutement (idu)');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF299B902AD');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2F7384557');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF299B902AD');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2F7384557');
        $this->addSql('ALTER TABLE panier CHANGE idu idu INT NOT NULL, CHANGE id_produit id_produit INT NOT NULL, CHANGE date_ajout date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (idu) REFERENCES utilisateur (idu) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_2 FOREIGN KEY (id_produit) REFERENCES produit (id_produit) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_24cc0df299b902ad ON panier');
        $this->addSql('CREATE INDEX idu ON panier (idu)');
        $this->addSql('DROP INDEX idx_24cc0df2f7384557 ON panier');
        $this->addSql('CREATE INDEX id_produit ON panier (id_produit)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF299B902AD FOREIGN KEY (idu) REFERENCES utilisateur (idu)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE produit CHANGE description description TEXT DEFAULT NULL, CHANGE categorie categorie VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE rating CHANGE note note DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE tournois CHANGE nomt nomt VARCHAR(20) NOT NULL, CHANGE descriptiont descriptiont VARCHAR(20) NOT NULL, CHANGE statutt statutt VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE transfert CHANGE ancienne_equipe ancienne_equipe VARCHAR(20) NOT NULL, CHANGE nouvelle_equipe nouvelle_equipe VARCHAR(20) NOT NULL, CHANGE datet datet DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL');
        $this->addSql('DROP INDEX UNIQ_1D1C63B38A3B8530 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP roles, CHANGE typeu typeu VARCHAR(20) NOT NULL, CHANGE code_expiration code_expiration DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
