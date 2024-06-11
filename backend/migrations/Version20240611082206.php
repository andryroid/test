<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611082206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE personne_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE acteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE film_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE acteur (id INT NOT NULL, nom VARCHAR(50) NOT NULL, genre SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE film (id INT NOT NULL, genre_id INT NOT NULL, acteur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, date_de_sortie TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, resume VARCHAR(255) NOT NULL, note INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8244BE224296D31F ON film (genre_id)');
        $this->addSql('CREATE INDEX IDX_8244BE22DA6F574A ON film (acteur_id)');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE224296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22DA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE personne');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE acteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE film_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE personne_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE personne (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE224296D31F');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE22DA6F574A');
        $this->addSql('DROP TABLE acteur');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE genre');
    }
}
