<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924173200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, adresse VARCHAR(100) DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, valider TINYINT(1) NOT NULL, reference INT NOT NULL, date_commande_at DATETIME NOT NULL, produits LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_35D4282CFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employes (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naissance_at DATETIME NOT NULL, lieu_naissance VARCHAR(50) NOT NULL, adresse VARCHAR(50) NOT NULL, nationalite VARCHAR(50) NOT NULL, civilite VARCHAR(50) NOT NULL, date_embauche_at DATETIME NOT NULL, fonction VARCHAR(50) NOT NULL, telephone VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, categorie VARCHAR(50) NOT NULL, numero_assurance_maladie INT DEFAULT NULL, type_contrat VARCHAR(50) NOT NULL, date_contrat_at DATETIME NOT NULL, situation_familiale VARCHAR(50) NOT NULL, nombre_enfant INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE familles (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, famille_id INT DEFAULT NULL, code VARCHAR(50) NOT NULL, designation VARCHAR(100) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, date_peremption_at DATETIME NOT NULL, nom_fabricant VARCHAR(50) DEFAULT NULL, forme VARCHAR(50) NOT NULL, quantite INT DEFAULT NULL, INDEX IDX_BE2DDF8C97A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salaires (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, nombre_heure INT DEFAULT NULL, taux_horaire DOUBLE PRECISION DEFAULT NULL, salaire_base INT NOT NULL, prime INT DEFAULT NULL, avantage INT DEFAULT NULL, salaire_brut INT NOT NULL, salaire_net INT NOT NULL, cotisation_social INT NOT NULL, mois VARCHAR(50) NOT NULL, INDEX IDX_718524441B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C97A77B84 FOREIGN KEY (famille_id) REFERENCES familles (id)');
        $this->addSql('ALTER TABLE salaires ADD CONSTRAINT FK_718524441B65292 FOREIGN KEY (employe_id) REFERENCES employes (id)');
        $this->addSql('DROP TABLE forme');
        $this->addSql('ALTER TABLE fournisseurs CHANGE nom nom VARCHAR(100) NOT NULL, CHANGE code numero VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E1B65292 FOREIGN KEY (employe_id) REFERENCES employes (id)');
        $this->addSql('CREATE INDEX IDX_497B315E1B65292 ON utilisateurs (employe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salaires DROP FOREIGN KEY FK_718524441B65292');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E1B65292');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C97A77B84');
        $this->addSql('CREATE TABLE forme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE employes');
        $this->addSql('DROP TABLE familles');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE salaires');
        $this->addSql('ALTER TABLE fournisseurs CHANGE nom nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE numero code VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_497B315E1B65292 ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP employe_id');
    }
}
