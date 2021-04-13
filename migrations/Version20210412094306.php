<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412094306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes ADD salaire_base DOUBLE PRECISION DEFAULT NULL, ADD salaire_brut DOUBLE PRECISION DEFAULT NULL, ADD salaire_net DOUBLE PRECISION DEFAULT NULL, ADD avantage DOUBLE PRECISION DEFAULT NULL, ADD prime DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE salaires DROP nombre_heure, DROP taux_horaire, DROP salaire_base, DROP prime, DROP avantage, DROP salaire_brut, DROP salaire_net, DROP cotisation_social');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes DROP salaire_base, DROP salaire_brut, DROP salaire_net, DROP avantage, DROP prime');
        $this->addSql('ALTER TABLE salaires ADD nombre_heure INT DEFAULT NULL, ADD taux_horaire DOUBLE PRECISION DEFAULT NULL, ADD salaire_base INT NOT NULL, ADD prime INT DEFAULT NULL, ADD avantage INT DEFAULT NULL, ADD salaire_brut INT NOT NULL, ADD salaire_net INT NOT NULL, ADD cotisation_social INT NOT NULL');
    }
}
