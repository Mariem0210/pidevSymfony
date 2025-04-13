<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407230801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_user_certificat ON certificat
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_formation_certificat ON certificat
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE certificat CHANGE nomc nomc VARCHAR(255) NOT NULL, CHANGE etatc etatc VARCHAR(20) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idu ON commande
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idu ON equipe
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipe CHANGE nom_equipe nom_equipe VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_user_formation ON formation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation CHANGE nomf nomf VARCHAR(255) NOT NULL, CHANGE niveauf niveauf VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE giveaway CHANGE titreg titreg VARCHAR(255) NOT NULL, CHANGE descg descg VARCHAR(255) NOT NULL, CHANGE statusg statusg VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` DROP FOREIGN KEY fk_tournois_match
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` DROP FOREIGN KEY fk_tournois_match
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` CHANGE idt idt INT DEFAULT NULL, CHANGE equipe1 equipe1 VARCHAR(255) NOT NULL, CHANGE equipe2 equipe2 VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE score score VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505EEBE323B FOREIGN KEY (idt) REFERENCES tournois (idt)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_tournois_match ON `match`
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7A5BC505EEBE323B ON `match` (idt)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` ADD CONSTRAINT fk_tournois_match FOREIGN KEY (idt) REFERENCES tournois (idt) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_user_offre ON offre_de_rectrutement
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE offre_de_rectrutement CHANGE poste_recherche poste_recherche VARCHAR(255) NOT NULL, CHANGE niveu_requis niveu_requis VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE contrat contrat VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idu ON panier
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_produit ON panier
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier CHANGE date_ajout date_ajout DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit CHANGE description description LONGTEXT DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating CHANGE note note NUMERIC(10, 0) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tournois CHANGE nomt nomt VARCHAR(255) NOT NULL, CHANGE descriptiont descriptiont VARCHAR(255) NOT NULL, CHANGE statutt statutt VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transfert CHANGE ancienne_equipe ancienne_equipe VARCHAR(255) NOT NULL, CHANGE nouvelle_equipe nouvelle_equipe VARCHAR(255) NOT NULL, CHANGE datet datet DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur CHANGE typeu typeu VARCHAR(30) NOT NULL, CHANGE code_expiration code_expiration DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE roles roles JSON NOT NULL COMMENT '(DC2Type:json)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1D1C63B38A3B8530 ON utilisateur (mailu)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE certificat CHANGE nomc nomc VARCHAR(100) NOT NULL, CHANGE etatc etatc VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_user_certificat ON certificat (idf)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_formation_certificat ON certificat (idu)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (idu) REFERENCES utilisateur (idu) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idu ON commande (idu)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipe CHANGE nom_equipe nom_equipe VARCHAR(50) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idu ON equipe (idu)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation CHANGE nomf nomf VARCHAR(30) NOT NULL, CHANGE niveauf niveauf VARCHAR(50) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_user_formation ON formation (idu)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE giveaway CHANGE titreg titreg VARCHAR(40) NOT NULL, CHANGE descg descg VARCHAR(50) NOT NULL, CHANGE statusg statusg VARCHAR(50) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505EEBE323B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505EEBE323B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` CHANGE idt idt INT NOT NULL, CHANGE equipe1 equipe1 VARCHAR(20) NOT NULL, CHANGE equipe2 equipe2 VARCHAR(20) NOT NULL, CHANGE status status VARCHAR(50) NOT NULL, CHANGE score score VARCHAR(20) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` ADD CONSTRAINT fk_tournois_match FOREIGN KEY (idt) REFERENCES tournois (idt) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_7a5bc505eebe323b ON `match`
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_tournois_match ON `match` (idt)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505EEBE323B FOREIGN KEY (idt) REFERENCES tournois (idt)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE offre_de_rectrutement CHANGE poste_recherche poste_recherche VARCHAR(50) NOT NULL, CHANGE niveu_requis niveu_requis VARCHAR(50) NOT NULL, CHANGE status status VARCHAR(50) NOT NULL, CHANGE contrat contrat VARCHAR(50) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_user_offre ON offre_de_rectrutement (idu)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier CHANGE date_ajout date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (idu) REFERENCES utilisateur (idu) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier ADD CONSTRAINT panier_ibfk_2 FOREIGN KEY (id_produit) REFERENCES produit (id_produit) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idu ON panier (idu)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_produit ON panier (id_produit)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produit CHANGE description description TEXT DEFAULT NULL, CHANGE categorie categorie VARCHAR(100) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rating CHANGE note note DOUBLE PRECISION NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tournois CHANGE nomt nomt VARCHAR(20) NOT NULL, CHANGE descriptiont descriptiont VARCHAR(20) NOT NULL, CHANGE statutt statutt VARCHAR(50) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transfert CHANGE ancienne_equipe ancienne_equipe VARCHAR(20) NOT NULL, CHANGE nouvelle_equipe nouvelle_equipe VARCHAR(20) NOT NULL, CHANGE datet datet DATE DEFAULT 'CURRENT_TIMESTAMP' NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_1D1C63B38A3B8530 ON utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur CHANGE typeu typeu VARCHAR(20) NOT NULL, CHANGE code_expiration code_expiration DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE roles roles VARCHAR(30) DEFAULT NULL
        SQL);
    }
}
